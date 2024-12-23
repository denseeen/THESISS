<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
 
use App\Models\CustomerInfo;
use App\Models\PaymentService;
use App\Models\Order;
use App\Models\InstallmentProcess;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
 
class AdminFetchingController extends Controller
{
 
 
 
 
    // public function InstallmentCustomer()
    // {
 
    //     $installments = DB::table('payment_service')
    //     ->join('customer_info', 'payment_service.id', '=', 'customer_info.id')
    //     ->where('payment_service.installment', 1)  // Filtering for records where installment is true
    //     ->select('customer_info.id', 'customer_info.name')
    //     ->distinct()  // Ensure unique names are returned
    //     ->get();
 
    //     $installments = CustomerInfo::where('customer_info.is_archived', false)
    //     ->join('installment_process', 'customer_info.id', '=', 'installment_process.customer_id') // Join on customer_id
    //     ->select('customer_info.id', 'customer_info.name')
    //     ->get();
 
    //     $installments = CustomerInfo::where('customer_info.is_archived', false)
    //         ->join('payment_service', 'customer_info.id', '=', 'payment_service.customer_id')
    //         ->where('payment_service.installment', 1)
    //         ->select('customer_info.id', 'customer_info.name')
    //         ->get();
 
   
    //     return view('about.adminnav.adinstallment', compact('installments'));
    // }
 
//  fetching installment customer name to the table with decryption
    public function InstallmentCustomer()
    {
        // Fetch customers who are not archived and have installments
        $installments = CustomerInfo::where('customer_info.is_archived', false)
            ->join('payment_service', 'customer_info.id', '=', 'payment_service.customer_id')
            ->where('payment_service.installment', 1)
            ->select('customer_info.id', 'customer_info.name') // Select id and name
            ->get();
   
        // Initialize an array to hold the final installment data with decrypted names
        $finalInstallments = [];
   
        foreach ($installments as $customer) {
            // Initialize an array to hold the decrypted customer data
            $decryptedCustomer = [
                'id' => $customer->id,
                'name' => null, // Placeholder for decrypted name
            ];
   
            // Attempt to decrypt the name
            try {
                // Attempt decryption
                $decryptedCustomer['name'] = Crypt::decryptString($customer->name); // Set the decrypted name
            } catch (DecryptException $e) {
                // If decryption fails, use the original name
                $decryptedCustomer['name'] = $customer->name; // Use original name if decryption fails
            }
   
            // Add the decrypted customer to the final array
            $finalInstallments[] = $decryptedCustomer;
        }
   
        // Pass the final installment data to the view
        return view('about.adminnav.adinstallment', compact('finalInstallments'));
    }
   
 
 
//  fetching fullypaid customer name to the table with decryption
public function FullyPaidCustomer()
{
    // Fetch fully paid customers who are not archived
    $fullpaids = CustomerInfo::where('customer_info.is_archived', false)
        ->join('payment_service', 'customer_info.id', '=', 'payment_service.customer_id')
        ->where('payment_service.fullypaid', 1)
        ->select('customer_info.id', 'customer_info.name') // Select id and name
        ->get();
 
    // Initialize an array to hold the final fully paid customers data with decrypted names
    $finalFullPaids = [];
 
    foreach ($fullpaids as $customer) {
        // Initialize an array to hold the decrypted customer data
        $decryptedCustomer = [
            'id' => $customer->id,
            'name' => null, // Placeholder for decrypted name
        ];
 
        // Attempt to decrypt the name
        try {
            // Decrypt the name and assign it
            $decryptedCustomer['name'] = Crypt::decryptString($customer->name);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, use the original encrypted name
            $decryptedCustomer['name'] = $customer->name; // Use original name if decryption fails
        }
 
        // Add the decrypted customer to the final array
        $finalFullPaids[] = $decryptedCustomer;
    }
 
    // Return the view with the final fully paid customers array
    return view('about.adminnav.adfullypaid', compact('finalFullPaids'));
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
 
    // Decrypt encrypted fields from the installment process before checking for existence
    $decryptedInstallmentProcess = $installmentProcess->map(function ($process) {
        try {
            $process->account_number = Crypt::decryptString($process->account_number);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, keep the encrypted value
        }
 
        try {
            $process->violation = $process->violation ? Crypt::decryptString($process->violation) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, keep the encrypted value
        }
 
        try {
            $process->comment = $process->comment ? Crypt::decryptString($process->comment) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, keep the encrypted value
        }
 
        try {
            $process->status = $process->status ? Crypt::decryptString($process->status) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, keep the encrypted value
        }
 
        try {
            $process->payment_method = $process->payment_method? Crypt::decryptString($process->payment_method) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, keep the encrypted value
        }
 
        return $process;
    });
 
    // If there are no orders, installment plan, or installment process, provide a default response
    if (!$orders || !$installmentPlan || $decryptedInstallmentProcess->isEmpty()) {
        return response()->json([
            'error' => 'No order or installment plan found for this customer.',
            'payment_schedule' => [],
            'installment_process' => [],
            'unit_price' => null,
            'remaining_balance' => null,
        ], 200); // Respond with a 200 status to indicate no schedule but not an error
    }
 
    // Proceed with processing decrypted installment process data...
    $unitPrice = $orders->unitprice;
    $statuses = $decryptedInstallmentProcess->pluck('status')->toArray();
    $amountsPaid = $decryptedInstallmentProcess->pluck('amount')->toArray();
 
    $paymentSchedule = [];
    $remainingBalance = $unitPrice;
 
    // Determine the installment duration and calculate payments
    $duration = 0;
    if ($installmentPlan->sixmonths) {
        $duration = 6;
    } elseif ($installmentPlan->twelvemonths) {
        $duration = 12;
    } elseif ($installmentPlan->eighteenmonths) {
        $duration = 18;
    }
 
    if ($duration === 0) {
        return response()->json([
            'error' => 'No installment plan selected for this customer.',
            'payment_schedule' => [],
            'installment_process' => [],
            'unit_price' => number_format($unitPrice, 2),
            'remaining_balance' => number_format($remainingBalance, 2),
        ], 200); // Return a 200 status instead of error to indicate no plan but continue normally
    }
 
    $monthlyPayment = $unitPrice / $duration;
 
    $startDate = new \DateTime($orders->dateOrder);
    $startDate->modify('+1 month');
 
    for ($i = 0; $i < $duration; $i++) {
        $paymentDate = clone $startDate;
        $paymentDate->modify("+{$i} month");
 
        $status = isset($statuses[$i]) ? $statuses[$i] : 'not paid';
        $amountPaid = isset($amountsPaid[$i]) ? $amountsPaid[$i] : 0;
 
        // Accumulate amounts paid and update the remaining balance
        $remainingBalance -= $amountPaid;
 
        $paymentSchedule[] = [
            'date' => $paymentDate->format('F j, Y'),
            'amount' => number_format($monthlyPayment, 2),
            'amount_paid' => number_format($amountPaid, 2),
            'status' => $status,
            'balance' => number_format($remainingBalance, 2),
        ];
    }
 
    // If the remaining balance is zero, it means the customer is fully paid
    if ($remainingBalance <= 0) {
        $remainingBalance = 0; // Ensure we show a clean zero for fully paid customers
    }
 
    return response()->json([
        'unit_price' => number_format($unitPrice, 2),
        'payment_schedule' => $paymentSchedule,
        'remaining_balance' => number_format($remainingBalance, 2),
        'installment_process' => $decryptedInstallmentProcess,
    ]);
}
 
 
 
 
// installment process/update button
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'customer_id'      => 'required|exists:customer_info,id', // Validate that the customer exists
            'account_number'   => 'nullable|numeric',
            'payment_method'   => 'nullable|string|in:otc,online',
            'amount'           => 'nullable|numeric',
            'date'             => 'nullable|date',
            'status'           => 'nullable|string|in:paid,fully_paid,not_paid',
            'violation'        => 'nullable|string|max:255',
            'comment'          => 'nullable|string|max:255',
        ]);
 
        // Create a new installment record
        $installmentProcess =  InstallmentProcess::create([
            'customer_id'          => $validatedData['customer_id'], // Store the customer ID
            'account_number'       => Crypt::encryptString($validatedData['account_number']),
            'payment_method'       => Crypt::encryptString($validatedData['payment_method']),
            'amount'               => $validatedData['amount'],
            'date'                 => $validatedData['date'],
            'status'               => Crypt::encryptString($validatedData['status']),
            'violation'            => Crypt::encryptString($validatedData['violation']),
            'comment'              => Crypt::encryptString($validatedData['comment']),
        ]);
 
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Installment created successfully!');
 
    }
 
 
// dashboard
// Get Expected Income (Sum of unit prices from Orders)
    public function getExpectedIncome()
    {
        $expectedIncome = Order::sum('unitprice');
        return response()->json(['expected_income' => $expectedIncome]);
    }
 
    public function getPaymentReceived()
    {
        $paymentReceived = InstallmentProcess::sum('amount'); // Make sure the model is correctly spelled
        return response()->json(['payment_received' => $paymentReceived]);
    }
 
    public function getInstallmentCount()
    {
        $installmentCount = PaymentService::where('installment', true)->count();
        return response()->json(['installment_count' => $installmentCount]);
    }
 
    public function getFullyPaidCount()
    {
        $fullyPaidCount = PaymentService::where('fullypaid', true)->count();
        return response()->json(['fully_paid_count' => $fullyPaidCount]);
    }
 
    public function getSalesUnitCount()
    {
        $salesUnitCount = Order::distinct('unitName')->count('unitName');
        return response()->json(['sales_unit_count' => $salesUnitCount]);
    }
 
 
// archive button
    public function archive(Request $request)
    {
        // Validate that customer_id is present
        $request->validate([
            'customer_id' => 'required|integer|exists:installment_process,customer_id',
        ]);
 
        // Find the installment by customer_id
        $installment = InstallmentProcess::where('customer_id', $request->customer_id)->first();
 
        if ($installment) {
            $installment->is_archived = true; // Mark the installment as archived
            $installment->save();
 
            // Optionally, if you want to archive the related customer as well
            $customer = CustomerInfo::find($installment->customer_id);
            if ($customer) {
                $customer->is_archived = true; // Archive the customer
                $customer->save();
            }
 
            // Fetch and archive the related orders
            $orders = $customer->orders; // Fetch related orders
 
            return redirect()->back()->with('success', 'Installment and customer archived successfully.');
        }
 
        return redirect()->back()->with('error', 'Installment not found.');
    }
 
// fetching archived customer name to the table with decryption
 
public function showArchived()
{
    // Fetch archived installments
    $archivedInstallments = InstallmentProcess::where('is_archived', true)->get();
 
    // Fetch archived installments along with customer, order, and payment service data
    $customers = InstallmentProcess::join('customer_info', 'installment_process.customer_id', '=', 'customer_info.id')
        ->join('orders', 'installment_process.customer_id', '=', 'orders.customer_id') // Join with orders table to get unitName
        ->leftJoin('payment_service', 'customer_info.id', '=', 'payment_service.customer_id') // Left join with payment_service table
        ->where('installment_process.is_archived', true) // Archived installments
        ->select(
            'installment_process.*',
            'customer_info.name as customer_name',
            'customer_info.phone_number as customer_phoneNum',
            'orders.*', // Fetch unitName from orders table
            'payment_service.installment', // Include installment status
            'payment_service.fullypaid' // Include fully paid status
        )
        ->get();
 
    // Group by customer and collect unit names in an array
    $yourSpecificIdsArray = $customers->groupBy('customer_id')->map(function ($customer) {
        // Initialize the array for the specific customer data
        $customerData = [
            'account_number' => $customer->first()->account_number,
            'customer_name' => null, // Placeholder for decrypted name
            'customer_phoneNum' => null, // Placeholder for decrypted phone number
            'unit_names' => $customer->pluck('unitName')->unique(), // Collect all unique unitNames for each customer
            'payment_service' => [
                'is_installment' => $customer->first()->installment ?? false, // Set boolean for installment
                'is_fully_paid' => $customer->first()->fullypaid ?? false, // Set boolean for fully paid
            ],
        ];
 
        // Attempt to decrypt the customer name
        try {
            $customerData['customer_name'] = Crypt::decryptString($customer->first()->customer_name); // Set the decrypted name
        } catch (DecryptException $e) {
            $customerData['customer_name'] = $customer->first()->customer_name; // Use original name if decryption fails
        }
 
        // Attempt to decrypt the customer phone number
        
        try {
            $customerData['account_number'] = Crypt::decryptString($customer->first()->account_number); // Set the decrypted phone number
        } catch (DecryptException $e) {
            $customerData['account_number'] = $customer->first()->account_number; // Use original phone number if decryption fails
        }
 
        return $customerData; // Return the customer data with decrypted name and phone number
    });
 
    // Return the view with the grouped customer data
    return view('about.adminnav.adarchived', compact('yourSpecificIdsArray', 'customers', 'archivedInstallments'));
}
 
 
 
// delete button at the archive view
    public function destroy($id)
    {
        $customer = CustomerInfo::find($id);
 
        if ($customer) {
            // Delete related records, if needed
            $customer->orders()->delete();
            $customer->installmentProcess()->delete();
 
            // Delete the customer record
            $customer->delete();
 
            return redirect()->back()->with('success', 'Customer deleted successfully');
        }
 
        return redirect()->back()->with('error', 'Customer not found');
    }
 
//addorder at fullypaid view
    public function addOrder(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer_id' => 'required|integer',
            'orderNumber'     => 'nullable|string|max:255',
            'unitName'        => 'nullable|string|max:255',
            'dateOrder'       => 'nullable|date',
            'unitprice'       => 'nullable|numeric',
            'unitDescription' => 'nullable|string',
        ]);
 
        // Use $validatedData after validation
        // For example, saving the order
        Order::create($validatedData);
 
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Installment created successfully!');
    }
 
 
 
//  installment and fullpaid name modal/double function on displaycontroller
// public function getCustomer($id)
// {
//     // Fetch customer details by ID
//     $customer = DB::table('customer_info')->where('id', $id)->first();
 
//     if (!$customer) {
//         return response()->json(['error' => 'Customer not found'], 404);
//     }
 
//     // Fetch the order details for the customer
//     $order = DB::table('orders')->where('customer_id', $customer->id)->first(); // Ensure 'customer_id' matches your actual column name
 
//     // Log the fetched order to check its contents
//     \Log::info('Order details:', (array) $order); // Log order details
 
//     return response()->json([
//         'name' => $customer->name,
//         'email' => $customer->email,
//         'phone_number' => $customer->phone_number,
//         'address' => $customer->streetaddress,
//         'unit_price' => $order ? $order->unitprice : null // Change to 'unitprice'
//     ]);
// }
 
// public function deleteCustomer($id)
// {
//     // Fetch the customer to check if it exists and is not deleted
//     $customer = DB::table('customer_info')
//         ->where('id', $id)
//         ->where('is_deleted', false)
//         ->first();
 
//     // Check if the customer exists
//     if (!$customer) {
//         return response()->json(['error' => 'Customer not found or already deleted.'], 404);
//     }
 
//     // Soft delete by updating the 'is_deleted' column
//     DB::table('customer_info')
//         ->where('id', $id)
//         ->update(['is_deleted' => true]);
 
//     return response()->json(['message' => 'Customer deleted successfully']);
// }
 
 
// public function showArchived()
// {
//     $archivedInstallments = InstallmentProcess::where('is_archived', true)->get();
 
//     // $customers = CustomerInfo::all();
 
//     $customers = InstallmentProcess::join('customer_info', 'installment_process.customer_id', '=', 'customer_info.id')
//     ->where('installment_process.is_archived', true) // Archived installments
//     ->where('customer_info.is_deleted', false)      // Only non-deleted customers
//     ->select('installment_process.*', 'customer_info.name as customer_name', 'customer_info.email as customer_email') // Select fields from both tables
//     ->get();
 
//     // Define your specific IDs array
//     $yourSpecificIdsArray = [1, 2, 3, 4, 11]; // Replace with your actual IDs
//     return view('about.adminnav.adarchived', compact('archivedInstallments', 'yourSpecificIdsArray','customers'));
// }
 
//  fetching customer list name to the table/ i use jason instead cuase this return undefined variable
    // public function AdminDashboardCustomerList()
    // {
    //     // Fetch customers
    //     $customer = DB::table('customer_info')->get();
   
    //     // Fetch customers and their payment methods
    //     $customerpm = DB::table('customer_info')
    //         ->leftJoin('payment_service', 'customer_info.id', '=', 'payment_service.id')
    //         ->select('customer_info.id', 'customer_info.name', 'payment_service.installment', 'payment_service.fullypaid')
    //         ->get();
   
    //     // Pass both variables to the view
    //     return view('about.adminnav.addashboard', compact('customer', 'customerpm'));
    // }
 
 
 
 
 
}