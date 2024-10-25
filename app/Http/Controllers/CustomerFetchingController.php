<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\PaymentService;
use App\Models\Order;
use App\Models\InstallmentProcess;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
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

        // Decrypt the account number if it exists
        $decryptedAccountNumber = $account && $account->account_number ? Crypt::decryptString($account->account_number) : null;

        // Prepare the response data
        $response = [
            'units' => $units, // All unit names and prices
            'account_number' => $decryptedAccountNumber, // Use the decrypted account number
        ];

        // Return the data as a JSON response
        return response()->json($response);
    }
 
 
 

    public function getBillingInfoAndPaymentSchedule()
{
    $userId = Auth::id();
    
    // Fetch customer info
    $customerInfo = DB::table('customer_info')->where('user_id', $userId)->first();
    
    if (!$customerInfo) {
        return response()->json(['error' => 'Customer not found'], 404);
    }
    
    // Fetch order and installment plan for the customer
    $orders = DB::table('orders')->where('customer_id', $customerInfo->id)->first();
    $installmentPlan = DB::table('installment_plan')->where('customer_id', $customerInfo->id)->first();
    
    if (!$orders || !$installmentPlan) {
        return response()->json(['error' => 'No valid order or installment plan found.'], 400);
    }

    // Calculate balance
    $totalUnitPrice = DB::table('orders')->where('customer_id', $customerInfo->id)->sum('unitprice');
    $totalPaid = DB::table('installment_process')
                    ->where('customer_id', $customerInfo->id)
                    ->where('status', 'paid')
                    ->sum('amount');
    $balance = $totalUnitPrice - $totalPaid;

    // Fetch and decrypt installment processes
    $installmentProcesses = DB::table('installment_process')
        ->where('customer_id', $customerInfo->id)
        ->orderBy('date', 'asc')
        ->get()
        ->map(function ($process) {
            foreach (['account_number', 'violation', 'comment', 'status', 'payment_method'] as $field) {
                try {
                    if (isset($process->$field)) {
                        $process->$field = $process->$field ? Crypt::decryptString($process->$field) : null;
                    }
                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    // Handle decryption errors if necessary
                }
            }
            return $process;
        });

    // Determine the installment duration
    if ($installmentPlan->sixmonths) {
        $duration = 6;
    } elseif ($installmentPlan->twelvemonths) {
        $duration = 12;
    } elseif ($installmentPlan->eighteenmonths) {
        $duration = 18;
    } else {
        return response()->json(['error' => 'No valid installment plan selected.'], 400);
    }
    
    // Monthly payment calculation
    $monthlyPayment = $orders->unitprice / $duration;

    // Set start date for payments
    $startDate = new \DateTime($orders->dateOrder);
    $startDate->modify('+1 month');
    
    // Generate payment schedule
    $paymentSchedule = [];
    $paymentIndex = 0;
    $overdueReminder = null;
    $currentDate = new \DateTime();

    foreach (range(0, $duration - 1) as $i) {
        $paymentDate = clone $startDate;
        $paymentDate->modify("+{$i} month");
        
        $status = 'not paid';
        
        if (isset($installmentProcesses[$paymentIndex])) {
            $process = $installmentProcesses[$paymentIndex];
            $processDate = new \DateTime($process->date);

            if ($process->status === 'paid') {
                $overdueThreshold = clone $paymentDate;
                $overdueThreshold->modify('+15 days');

                $status = ($processDate > $overdueThreshold) ? 'overdue-paid' : 'paid';
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

    // Find the next unpaid payment
    $nextPaymentDue = null;
    $nextPaymentAmount = null;

    foreach ($paymentSchedule as $payment) {
        if ($payment['status'] === 'not paid') {
            $nextPaymentDue = $payment['date'];
            $nextPaymentAmount = $payment['amount'];
            break;
        }
    }

    // Prepare response data
    $response = [
        'currentMonthlyBill' => isset($installmentProcesses[0]) ? number_format($installmentProcesses[0]->amount, 2) : 0,
        'nextPaymentDue' => $nextPaymentDue ?: 'N/A',
        'nextPaymentAmount' => $nextPaymentAmount ?: 0,
        'balance' => $balance == 0 ? "Your Monthly Payment is Finished!" : number_format($balance, 2),
        'unit_price' => number_format($orders->unitprice, 2),
        'payment_schedule' => $paymentSchedule,
        'overdueReminder' => $overdueReminder,
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
                        ->select('customer_id', 'date', 'amount', 'payment_method', 'violation', 'comment', 'account_number')
                        ->orderBy('date', 'asc')
                        ->get();

    // Initialize an array to hold the decrypted billing history
    $finalBillingHistory = [];

    // Decrypt the 'payment_method', 'violation', 'comment', and 'account_number' fields for each billing history entry
    foreach ($billingHistory as $entry) {
        // Initialize an array to hold the decrypted billing data
        $decryptedEntry = [
            'customer_id' => $entry->customer_id,
            'date' => $entry->date,
            'amount' => $entry->amount,
            'payment_method' => null, // Placeholder for decrypted payment_method
            'violation' => null, // Placeholder for decrypted violation
            'comment' => null, // Placeholder for decrypted comment
            'account_number' => null // Placeholder for decrypted account_number
        ];

        // Attempt to decrypt the payment method
        try {
            $decryptedEntry['payment_method'] = $entry->payment_method ? Crypt::decryptString($entry->payment_method) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $decryptedEntry['payment_method'] = $entry->payment_method; // Use original if decryption fails
        }

        // Attempt to decrypt the violation
        try {
            $decryptedEntry['violation'] = $entry->violation ? Crypt::decryptString($entry->violation) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $decryptedEntry['violation'] = $entry->violation; // Use original if decryption fails
        }

        // Attempt to decrypt the comment
        try {
            $decryptedEntry['comment'] = $entry->comment ? Crypt::decryptString($entry->comment) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $decryptedEntry['comment'] = $entry->comment; // Use original if decryption fails
        }

        // Attempt to decrypt the account number
        try {
            $decryptedEntry['account_number'] = $entry->account_number ? Crypt::decryptString($entry->account_number) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $decryptedEntry['account_number'] = $entry->account_number; // Use original if decryption fails
        }

        // Add the decrypted entry to the final array
        $finalBillingHistory[] = $decryptedEntry;
    }

    // Return the JSON response with the decrypted billing history
    return response()->json($finalBillingHistory);
}


 
}