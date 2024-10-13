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

    // Get unpaid payments from the payment schedule for the current user
    $currentPayment = DB::table('installment_process')
        ->where('customer_id', $customerInfo->id)
        ->where('status', 'unpaid')
        ->orderBy('date', 'asc')
        ->first();

    // Calculate the balance
    $totalUnitprice = DB::table('orders')->where('customer_id', $customerInfo->id)->sum('unitprice');
    $totalPaid = DB::table('installment_process')
        ->where('customer_id', $customerInfo->id)
        ->where('status', 'paid')
        ->sum('amount');
    $balance = $totalUnitprice - $totalPaid;

    // Fetch customer's installment plan and orders
    $installmentPlan = DB::table('installment_plan')->where('customer_id', $customerInfo->id)->first();
    $orders = DB::table('orders')->where('customer_id', $customerInfo->id)->first();
    $installmentProcess = DB::table('installment_process')
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
        return response()->json(['error' => 'No installment plan selected.'], 400);
    }

    // Calculate monthly payment
    $monthlyPayment = $orders->unitprice / $duration;

    // Start date for payment (one month after the order date)
    $startDate = new \DateTime($orders->dateOrder);
    $startDate->modify('+1 month'); // Move one month ahead

    $paymentSchedule = [];
    $paymentIndex = 0; // Track which payment we are processing

    // Iterate through the duration to generate the schedule
    foreach (range(0, $duration - 1) as $i) {
        $paymentDate = clone $startDate;
        $paymentDate->modify("+{$i} month");

        // Default status for payments
        $status = 'not paid';

        if (isset($installmentProcess[$paymentIndex])) {
            $process = $installmentProcess[$paymentIndex];
            $processDate = new \DateTime($process->date);

            if ($processDate < $paymentDate) {
                $status = 'paid in advance';
            } elseif ($processDate->format('Y-m-d') === $paymentDate->format('Y-m-d')) {
                $status = $process->status; // 'paid' or 'paid late'
            }
            $paymentIndex++; // Move to the next payment only if it's marked as paid
        }

        $paymentSchedule[] = [
            'date' => $paymentDate->format('F j, Y'),
            'amount' => number_format($monthlyPayment, 2),
            'status' => $status,
        ];
    }

    // Get next payment due and its amount
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
        'currentMonthlyBill' => $currentPayment ? $currentPayment->amount : 0,
        'nextPaymentDue' => $nextPaymentDue ?: 'N/A',
        'nextPaymentAmount' => $nextPaymentAmount ?: 0,
        'balance' => $balance,
        'unit_price' => number_format($orders->unitprice, 2),
        'payment_schedule' => $paymentSchedule,
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