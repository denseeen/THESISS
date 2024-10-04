<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CustomerInfo;
use App\Models\PaymentService;
use App\Models\Order;
use App\Models\InstallmentProcess;
use Carbon\Carbon; 

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminFetchingController extends Controller
{
    public function AdminDashboardCustomerList()
    {
    // Fetch customers
    $customer = DB::table('customer_info')->get();
 
    // Fetch customers and their payment methods
    $customerpm = DB::table('customer_info')
        ->leftJoin('payment_service', 'customer_info.id', '=', 'payment_service.id')
        ->select('customer_info.id', 'customer_info.name', 'payment_service.installment', 'payment_service.fullypaid')
        ->get();
 
    // Pass both variables to the view
    return view('about.adminnav.addashboard', compact('customer', 'customerpm'));
}





public function InstallmentCustomer()
{
    $installments = DB::table('payment_service')
    ->join('customer_info', 'payment_service.id', '=', 'customer_info.id')
    ->where('payment_service.installment', 1)  // Filtering for records where installment is true
    ->select('customer_info.id', 'customer_info.name')
    ->distinct()  // Ensure unique names are returned
    ->get();

 
    return view('about.adminnav.adinstallment', compact('installments'));
}


 
public function FullyPaidCustomer()
{
    $fullpaids = DB::table('payment_service')
        ->join('customer_info', 'payment_service.id', '=', 'customer_info.id')
        ->where('payment_service.fullypaid', 1)  // Filtering for records where fullypaid is true
        ->select('customer_info.id', 'customer_info.name')  // Include customer_id to use in the modal
        ->distinct()  // Ensure unique names are returned
        ->get();
 
    return view('about.adminnav.adfullypaid', compact('fullpaids'));
}
 

 
public function getCustomer($id)
    {
        // Fetch customer details by ID
        $customer = DB::table('customer_info')->where('id', $id)->first();
 
 
        if ($customer) {
            return response()->json([
                'name' => $customer->name,
                'email' => $customer->email,
                'phone_number' => $customer->phone_number,
                'address' => $customer->streetaddress
            ]);
        }
 
        return response()->json(['error' => 'Customer not found'], 404);
    }
 
 
 
    public function getPaymentSchedule($customerId)
{
    // Fetch customer's installment plan
    $installmentPlan = DB::table('installment_plan')
        ->where('customer_id', $customerId)
        ->first();
 
    // Fetch customer's orders
    $orders = DB::table('orders')
        ->where('customer_id', $customerId)
        ->first();

    // Fetch customer's installment process
    $installmentProcess = DB::table('installment_process')
        ->where('customer_id', $customerId)
        ->get();
 
    // Check if the order exists
    if (!$orders || !$installmentPlan || !$installmentProcess) {
        return response()->json(['error' => 'No order or installment plan found for this customer.'], 404);
    }
 
    $unitPrice = $orders->unitprice; // Assuming you have a unit price in the orders
    $statuses = $installmentProcess->pluck('status')->toArray(); // Fetch all statuses into an array

    $paymentSchedule = [];
 
    // Determine the installment duration and calculate payments
    if ($installmentPlan->sixmonths) {
        $duration = 6;
    } elseif ($installmentPlan->twelvemonths) {
        $duration = 12;
    } elseif ($installmentPlan->eighteenmonths) {
        $duration = 18;
    } else {
        return response()->json(['error' => 'No installment plan selected.'], 400);
    }
 
    // Calculate the monthly payment amount
    $monthlyPayment = $unitPrice / $duration;
 
    // Start date: one month before the order date
    $startDate = new \DateTime($orders->dateOrder);
    $startDate->modify('+1 month'); // Move to one month before
 
    // Generate the payment schedule
    for ($i = 0; $i < $duration; $i++) {
        // Clone the start date and add months
        $paymentDate = clone $startDate;
        $paymentDate->modify("+{$i} month");
        
        // Assign status from installment_process (or default to 'not_paid' if no status exists)
        $status = isset($statuses[$i]) ? $statuses[$i] : 'not paid';
 
        // Format the payment date and add to schedule
        $paymentSchedule[] = [
            'date' => $paymentDate->format('F j, Y'), // e.g., "April 5, 2024"
            'amount' => number_format($monthlyPayment, 2), // Format to 2 decimal places
            'status' => $status // Add the corresponding status for the month
        ];
    }
 
    return response()->json([
        'unit_price' => number_format($unitPrice, 2),
        'payment_schedule' => $paymentSchedule,
        'installment_process' => $installmentProcess, // Include installment process data
    ]);
}

  


    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'customer_id'      => 'required|exists:customer_info,id', // Validate that the customer exists
        'payment_method'   => 'required|string|in:otc,online',
        'amount'           => 'required|numeric',
        'date'             => 'required|date',
        'status'           => 'required|string|in:paid,not_paid',
        'violation'        => 'nullable|string|max:255',
        'comment'          => 'nullable|string|max:255',
    ]);

    // Create a new installment record
      $installmentProcess =  InstallmentProcess::create([
        'customer_id'          => $validatedData['customer_id'], // Store the customer ID
        'payment_method'       => $validatedData['payment_method'],
        'amount'               => $validatedData['amount'],
        'date'                 => $validatedData['date'],
        'status'               => $validatedData['status'],
        'violation'            => $validatedData['violation'],
        'comment'              => $validatedData['comment'],
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Installment created successfully!');

}
}