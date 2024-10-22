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
 
class CustomerFetchingController extends Controller
{
 
 
    public function getUnitDetails()
{
    $userId = Auth::id(); // Get the authenticated user ID
 
    // Fetch the customer ID associated with the authenticated user
    $customer = DB::table('customer_info')
        ->where('user_id', $userId)
        ->select('id as customer_id')
        ->first();
 
    // If the customer doesn't exist, return an error response
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }
 
    // Fetch all unit names and prices for the customer from the orders table
    $units = DB::table('orders')
        ->where('customer_id', $customer->customer_id) // Use the customer_id obtained
        ->select('unitName as unitname', 'unitprice')
        ->get(); // Use get() to fetch all units
 
    // Fetch the account number from the installment_process table using customer_id
    $account = DB::table('installment_process')
        ->where('customer_id', $customer->customer_id) // Use the customer_id obtained
        ->select('account_number')
        ->first();
 
    // Prepare the response data
    $response = [
        'units' => $units, // All unit names and prices
        'account_number' => $account ? $account->account_number : null,
    ];
 
    // Return the data as a JSON response
    return response()->json($response);
}
 
 
 
public function getBillingInfoAndPaymentSchedule()
{
    $userId = Auth::id(); // Get the authenticated user
 
    // Fetch customer info
    $customerInfo = DB::table('customer_info')->where('user_id', $userId)->first();
 
    if (!$customerInfo) {
        return response()->json(['error' => 'Customer not found'], 404);
    }
 
    // Calculate the balance
    $totalUnitPrice = DB::table('orders')->where('customer_id', $customerInfo->id)->sum('unitprice');
    $totalPaid = DB::table('installment_process')
        ->where('customer_id', $customerInfo->id)
        ->where('status', 'paid')
        ->sum('amount');
    $balance = $totalUnitPrice - $totalPaid;
 
    // Fetch customer's installment plan and orders
    $installmentPlan = DB::table('installment_plan')->where('customer_id', $customerInfo->id)->first();
    $orders = DB::table('orders')->where('customer_id', $customerInfo->id)->first();
    $installmentProcesses = DB::table('installment_process')
        ->where('customer_id', $customerInfo->id)
        ->orderBy('date', 'asc')
        ->get();
 
    if (!$orders || !$installmentPlan) {
        return response()->json(['error' => 'No order or installment plan found for this customer.'], 404);
    }
 
    // Determine installment plan duration
    if ($installmentPlan->sixmonths) {
        $duration = 6;
    } elseif ($installmentPlan->twelvemonths) {
        $duration = 12;
    } elseif ($installmentPlan->eighteenmonths) {
        $duration = 18;
    } else {
        return response()->json(['error' => 'No valid installment plan selected.'], 400);
    }
 
    // Calculate monthly payment
    $monthlyPayment = $orders->unitprice / $duration;
 
    // Start date for payment (one month after the order date)
    $startDate = new \DateTime($orders->dateOrder);
    $startDate->modify('+1 month'); // Move one month ahead
 
    // Generate payment schedule and determine status
    $paymentSchedule = [];
    $paymentIndex = 0;
    $overdueReminder = null;
    $currentDate = new \DateTime();
 
    // Iterate through the duration to generate the schedule
    foreach (range(0, $duration - 1) as $i) {
        $paymentDate = clone $startDate;
        $paymentDate->modify("+{$i} month");
 
        $status = 'not paid'; // Default status
 
        if (isset($installmentProcesses[$paymentIndex])) {
            $process = $installmentProcesses[$paymentIndex];
            $processDate = new \DateTime($process->date);
 
            if ($process->status === 'paid') {
                $overdueThreshold = clone $paymentDate;
                $overdueThreshold->modify('+15 days');
               
                // Check if the payment was late
                if ($processDate > $overdueThreshold) {
                    $status = 'overdue-paid';
                } else {
                    $status = 'paid';
                }
            } elseif ($processDate < $paymentDate) {
                $status = 'paid in advance';
            }
 
            $paymentIndex++;
        }
 
        $overdueThreshold = clone $paymentDate;
        $overdueThreshold->modify('+15 days');
 
        if ($status === 'not paid' && $currentDate > $overdueThreshold) {
            $overdueReminder = 'Reminder: The unit is going to be pulled out if payment is not made for the overdue amount.';
        }
 
        $paymentSchedule[] = [
            'date' => $paymentDate->format('F j, Y'),
            'amount' => number_format($monthlyPayment, 2),
            'status' => $status,
        ];
    }
 
    // Get next unpaid payment
    $nextPaymentDue = null;
    $nextPaymentAmount = null;
 
    foreach ($paymentSchedule as $payment) {
        if ($payment['status'] === 'not paid') {
            $nextPaymentDue = $payment['date'];
            $nextPaymentAmount = $payment['amount'];
            break;
        }
    }
 
    $response = [
        'currentMonthlyBill' => isset($installmentProcesses[0]) ? number_format($installmentProcesses[0]->amount, 2) : 0,
        'nextPaymentDue' => $nextPaymentDue ?: 'N/A',
        'nextPaymentAmount' => $nextPaymentAmount ?: 0,
        'balance' => $balance, 2,
        'unit_price' => number_format($orders->unitprice, 2),
        'payment_schedule' => $paymentSchedule,
        'overdueReminder' => $overdueReminder, // Add overdue reminder if present
    ];
 
    return response()->json($response);
}
 
 
 
 
   
public function getBillingHistory()
{
    $userId = Auth::id(); // Get the currently authenticated user
 
    // Fetch the customer information
    $customerInfo = DB::table('customer_info')->where('user_id', $userId)->first();
 
    if (!$customerInfo) {
        return response()->json(['error' => 'Customer not found'], 404);
    }
 
    // Get the customer's installment process (billing history)
    $billingHistory = DB::table('installment_process')
                        ->where('customer_id', $customerInfo->id)
                        ->select('customer_id', 'date', 'amount', 'payment_method', 'violation', 'comment')
                        ->orderBy('date', 'asc')
                        ->get();
 
    return response()->json($billingHistory);
}
 
}