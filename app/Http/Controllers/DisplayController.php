<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CustomerInfo;
use App\Models\AdminInfo;
use App\Models\User;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DisplayController extends Controller
{

// customer profile
public function user_infos()
{
    $userId = Auth::id(); // Get the current user's ID
    $infos = DB::table('customer_info')
    ->join('users', 'customer_info.user_id', '=', 'users.id')
    ->select('customer_info.*', 'users.name', 'users.email') // Select fields you need
    ->where('customer_info.user_id', $userId)
    ->first();

    return view('about.customernav.cusprofile')->with('infos', $infos);
}

// admin profile
public function user_infos_admin()
{
    $userId = Auth::id(); // Get the current user's ID
    $info = DB::table('admin_info')
    ->join('users', 'admin_info.user_id', '=', 'users.id')
    ->select('admin_info.*', 'users.name', 'users.email') // Select fields you need
    ->where('admin_info.user_id', $userId)
    ->first();

    return view('about.adminnav.adprofile')->with('info', $info); 
}



// admin customer List
public function getCustomers()
{
    // Fetch customers and their payment service details
    $customers = DB::table('customer_info')
        ->leftJoin('payment_service', 'customer_info.id', '=', 'payment_service.customer_id')
        ->select('customer_info.id', 'customer_info.name', 'payment_service.installment', 'payment_service.fullypaid')
        ->get();

    // Iterate through each customer to calculate their balance and unit price sum
    foreach ($customers as $customer) {
        // Fetch installment plan for the customer
        $installmentPlan = DB::table('installment_plan')->where('customer_id', $customer->id)->first();

        // Fetch the total sum of unit prices from the orders table for the customer
        $totalUnitPrice = DB::table('orders')
            ->where('customer_id', $customer->id)
            ->sum('unitprice');

        // Fetch the total sum of amounts paid from the installment_process table
        $totalPaidAmount = DB::table('installment_process')
            ->where('customer_id', $customer->id)
            ->sum('amount');

        // If the installment plan exists
        if ($installmentPlan) {
            // Calculate the remaining balance
            $remainingBalance = $totalUnitPrice - $totalPaidAmount;

            // Attach the calculated remaining balance and total unit price to the customer object
            $customer->remaining_balance = number_format($remainingBalance, 2);
            $customer->total_unit_price = number_format($totalUnitPrice, 2);
            $customer->total_paid_amount = number_format($totalPaidAmount, 2);
        } else {
            // Set balance and unit price to 0 if no data is available
            $customer->remaining_balance = '0.00';
            $customer->total_unit_price = '0.00';
            $customer->total_paid_amount = '0.00';
        }
    }

    // Return JSON response with customer data including remaining balance, total unit price, and total paid amount
    return response()->json($customers);
}




// fullypaid and installment modal customer info, + fullypaid balance and invoice.
public function getCustomer($id)
{
    // Fetch customer details by ID
    $customer = DB::table('customer_info')->where('id', $id)->first();

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Fetch all unit prices and unit names from the orders table for this customer
    $orders = DB::table('orders')
        ->where('customer_id', $customer->id)
        ->select('unitprice', 'unitname') // Include unitname in the selection
        ->get();

    // Calculate total unit price
    $totalUnitPrice = $orders->sum('unitprice');

    // Concatenate all unit names into a string
    $unitNames = $orders->pluck('unitname')->implode(', '); // Concatenate unit names

    // Fetch the installment records for this customer
    $fullypaidprocess = DB::table('installment_process')
        ->where('customer_id', $customer->id)
        ->select('account_number', 'date', 'amount', 'payment_method', 'status', 'violation', 'comment')
        ->get();

    // Calculate total amount paid from the fetched installment records
    $totalAmountPaid = $fullypaidprocess->sum('amount');

    // Calculate balance
    $balance = $totalUnitPrice - $totalAmountPaid;

    return response()->json([
        'name' => $customer->name,
        'email' => $customer->email,
        'phone_number' => $customer->phone_number,
        'address' => $customer->streetaddress,
        'unit_price' => $totalUnitPrice > 0 ? $totalUnitPrice : 'N/A', // Total unit price
        'amount' => $totalAmountPaid, // Total amount paid
        'balance' => $balance, // Calculate and return balance
        'installments' => $fullypaidprocess, // Include installment records
        'unitnames' => $unitNames // Include concatenated unit names
    ]);
}






// public function admin_dashboard()
// {
//     // Pass both variables to the view
//     return view('about.adminnav.addashboard'); 
// }



// public function cusInstallments()
// {
//     $installments = DB::table('payment_service')
//     ->join('customer_info', 'payment_service.customer_id', '=', 'customer_info.id')
//     ->where('payment_service.installment', 1)  // Filtering for records where installment is true
//     ->select('customer_info.id', 'customer_info.name')
//     ->distinct()  // Ensure unique names are returned
//     ->get();

//     return view('about.adminnav.adinstallment', compact('installments'));
// }



// public function cusfullypaid()
// {
//     $fullpaids = DB::table('payment_service')
//         ->join('customer_info', 'payment_service.customer_id', '=', 'customer_info.id')
//         ->where('payment_service.fullypaid', 1)  // Filtering for records where fullypaid is true
//         ->select('customer_info.id', 'customer_info.name')  // Include customer_id to use in the modal
//         ->distinct()  // Ensure unique names are returned
//         ->get();

//     return view('about.adminnav.adfullypaid', compact('fullpaids'));
// }





}



?>
