<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Models\CustomerInfo;
use App\Models\AdminInfo;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
 
 
class DisplayController extends Controller
{
 
// customer profile decrypted//den
public function user_infos()
{
    $userId = Auth::id(); // Get the current user's ID
 
    // Fetch user info and related customer data
    $infos = DB::table('customer_info')
        ->join('users', 'customer_info.user_id', '=', 'users.id')
        ->select('customer_info.*', 'users.email') // Select fields you need, including email from users table
        ->where('customer_info.user_id', $userId)
        ->first();
 
        if ($info) {
            // Log the raw encrypted info for debugging
            \Log::info("Raw encrypted admin info: ", (array)$info);
        
            // Decrypt fields with error handling
            $fieldsToDecrypt = ['name', 'email', 'facebook', 'streetaddress', 'phone_number', 'gender', 'telephone_number'];
        
            foreach ($fieldsToDecrypt as $field) {
                try {
                    if (isset($info->$field)) {
                        // Attempt to decrypt each field
                        $info->$field = Crypt::decryptString($info->$field);
                        \Log::info("Decrypted field '{$field}': " . $info->$field);
                    }
                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    // Log the error and the value that failed to decrypt
                    \Log::error("Decryption failed for field '{$field}' of user ID: {$userId}. Encrypted value: " . $info->$field . ". Error: " . $e->getMessage());
                    // Optionally assign a placeholder for fields that fail to decrypt
                    $info->$field = 'Decryption Failed';
                }
            }
        } else {
            \Log::warning("No admin info found for user ID: {$userId}.");
        }
        
 
    // Return the view with the decrypted infos
    return view('about.customernav.cusprofile')->with('infos', $infos);
}



public function user_infos_admin()
{
    // Get the current user's ID
    $userId = Auth::id();

    // Check if the user is authenticated
    if (!$userId) {
        \Log::warning("Attempted to fetch admin info without an authenticated user.");
        return redirect()->route('login')->withErrors('You need to be logged in to access this page.');
    }

    // Fetch admin info based on the user ID
    $info = DB::table('admin_info')->where('user_id', $userId)->first();

    // Check if $info is null
    if ($info === null) {
        \Log::warning("No admin info found for user ID: {$userId}.");
        return view('about.adminnav.adprofile')->with('info', null);
    }

    // Log the fetched info for debugging
    \Log::info("Fetched admin info: ", (array)$info);

    // Decrypt fields with error handling
    $fieldsToDecrypt = ['name', 'email', 'facebook', 'streetaddress', 'phone_number', 'gender', 'telephone_number'];

    foreach ($fieldsToDecrypt as $field) {
        try {
            if (isset($info->$field)) {
                // Attempt to decrypt each field
                $info->$field = Crypt::decryptString($info->$field);
                \Log::info("Decrypted field '{$field}': " . $info->$field);
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Log the error and the value that failed to decrypt
            \Log::error("Decryption failed for field '{$field}' of user ID: {$userId}. Encrypted value: " . $info->$field . ". Error: " . $e->getMessage());
            // Optionally assign a placeholder for fields that fail to decrypt
            $info->$field = 'Decryption Failed';
        }
    }

    // Return the view with the admin info
    return view('about.adminnav.adprofile')->with('info', $info);
}



// admin profile decrypted
// public function user_infos_admin()
// {
//     $userId = Auth::id(); // Get the current user's ID
 
//     // Fetch user info and related admin data
//     $info = DB::table('admin_info')
//         ->join('users', 'admin_info.user_id', '=', 'users.id')
//         ->select('admin_info.*', 'users.name', 'users.email') // Select fields you need, including name and email from users table
//         ->where('admin_info.user_id', $userId)
//         ->first();
 
//     // Check if user info is found
//     if ($info) {
//         // Decrypt fields with error handling
//         $fieldsToDecrypt = ['name', 'email', 'address', 'phone_number', 'facebook', 'gender', 'telephone_number'];
 
//         foreach ($fieldsToDecrypt as $field) {
//             try {
//                 if (isset($info->$field)) {
//                     // Attempt to decrypt each field
//                     $info->$field = Crypt::decryptString($info->$field);
//                 }
//             } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
//                 // Log the error
//                 \Log::error("Decryption failed for field '{$field}' of admin ID: {$userId}. Error: " . $e->getMessage());
//                 // Optionally assign a placeholder for fields that fail to decrypt
//                 $info->$field = 'Decryption Failed';
//             }
//         }
//     }
 
//     // Return the view with the decrypted info
//     return view('about.adminnav.adprofile')->with('info', $info);
// }
 
 
 
 
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
        // Attempt to decrypt the name
        try {
            $customer->name = Crypt::decryptString($customer->name);
        } catch (DecryptException $e) {
            // Log the error and retain the original name if decryption fails
            \Log::error('Decryption failed for customer ID: ' . $customer->id . ' - Error: ' . $e->getMessage());
        }

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

        // Initialize variables for overall balance calculation
        $discount = 0;
        $penalty = 0;

        // If the installment plan exists
        if ($installmentPlan) {
            // Determine the installment duration
            $duration = $installmentPlan->sixmonths ? 6 : ($installmentPlan->twelvemonths ? 12 : ($installmentPlan->eighteenmonths ? 18 : 0));

            // Generate payment schedule dates based on the duration
            $payment_schedule = [];
            for ($i = 0; $i < $duration; $i++) {
                $payment_schedule[] = now()->addMonths($i); // Create payment dates
            }

            // Initialize remaining balance and status
            $remainingBalance = $totalUnitPrice - $totalPaidAmount;
            $status = 'paid'; // Default status

            // Calculate penalties and discounts
            foreach ($payment_schedule as $scheduleDate) {
                // Fetch installment processes for each payment schedule date
                $installmentProcesses = DB::table('installment_process')
                    ->where('customer_id', $customer->id)
                    ->whereDate('date', $scheduleDate) // Fetch processes for the exact scheduled date
                    ->get();

                // Initialize a flag for the status in this iteration
                $iterationStatus = 'paid'; // Default status for this iteration

                foreach ($installmentProcesses as $process) {
                    $installmentDate = new \Carbon\Carbon($process->date); // Date when the customer made the payment
                    $gracePeriodEnd = (new \Carbon\Carbon($scheduleDate))->addDays(3); // 3-day grace period

                    // Determine the status based on the process date
                    if ($installmentDate < $scheduleDate) {
                        // Paid in advance: Apply discount
                        $discountAmount = 100; // Discount amount
                        $remainingBalance = max(0, $remainingBalance - $discountAmount); // Update balance
                        $iterationStatus = 'paid advance'; // Update status to paid in advance
                    } elseif ($installmentDate->isSameDay($scheduleDate)) {
                        // Paid exactly on time: No discount or penalty
                        $iterationStatus = 'paid'; // No changes
                    } elseif ($installmentDate > $gracePeriodEnd) {
                        // Late payment by more than 3 days: Apply penalty
                        $penaltyAmount = ($totalUnitPrice / $duration) * 0.10; // 10% of the installment amount
                        $remainingBalance += $penaltyAmount; // Update balance with penalty
                        $iterationStatus = 'paid late'; // Update status to paid late
                    } else {
                        // Paid within the 3-day grace period: No penalty
                        $iterationStatus = 'paid'; // No changes
                    }
                }

                // After processing all payments for this schedule date, determine the overall status
                if ($iterationStatus === 'paid' && $installmentProcesses->isEmpty()) {
                    // If no payments were made for this date, mark as unpaid
                    $iterationStatus = 'unpaid';
                }

                // Set the status for this customer based on the iteration
                $status = $iterationStatus;
            }

            // Calculate overall balance
            $overallBalance = $totalUnitPrice - $totalPaidAmount - $discount + $penalty;

            // Attach the calculated remaining balance and totals to the customer object
            $customer->remaining_balance = number_format($remainingBalance, 2);
            $customer->overall_balance = number_format($overallBalance, 2); // Add overall balance
            $customer->total_unit_price = number_format($totalUnitPrice, 2);
            $customer->total_paid_amount = number_format($totalPaidAmount, 2);
            $customer->status = $status; // Attach the final status
        } else {
            // Set balance and unit price to 0 if no data is available
            $customer->remaining_balance = '0.00';
            $customer->overall_balance = '0.00'; // No overall balance
            $customer->total_unit_price = '0.00';
            $customer->total_paid_amount = '0.00';
            $customer->status = 'no plan'; // No installment plan
        }
    }

    // Return JSON response with customer data including remaining balance, total unit price, total paid amount, and overall balance
    return response()->json($customers);
}


 
 
 
 
//  fullypaid process
public function getCustomer($id)
{
    // Fetch customer details by ID
    $customer = DB::table('customer_info')->where('id', $id)->first();

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Initialize an array to hold decrypted values
    $decryptedData = [];

    // List of fields to check for encryption
    $fieldsToCheck = ['email', 'phone_number', 'streetaddress', 'name']; // Add any other fields you want to check

    foreach ($fieldsToCheck as $field) {
        $originalValue = $customer->$field; // Get the original value

        try {
            // Attempt decryption
            $decryptedValue = Crypt::decryptString($originalValue);
            $decryptedData[$field] = $decryptedValue; // Use the decrypted value if successful
        } catch (DecryptException $e) {
            // If decryption fails, use the original value
            $decryptedData[$field] = $originalValue;
        }
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

    // Initialize an array for decrypted installment data
    $decryptedInstallments = [];

    // List of fields to check for encryption in installment process
    $installmentFieldsToCheck = ['account_number', 'payment_method', 'status', 'violation', 'comment'];

    // Decrypt installment process records
    foreach ($fullypaidprocess as $installment) {
        $decryptedInstallment = (array) $installment; // Convert object to array for easier manipulation

        foreach ($installmentFieldsToCheck as $field) {
            $originalValue = $installment->$field; // Get the original value for each field

            try {
                // Attempt decryption
                $decryptedValue = Crypt::decryptString($originalValue);
                $decryptedInstallment[$field] = $decryptedValue; // Use the decrypted value if successful
            } catch (DecryptException $e) {
                // If decryption fails, use the original value
                $decryptedInstallment[$field] = $originalValue;
            }
        }

        // Add decrypted installment record to the array
        $decryptedInstallments[] = $decryptedInstallment;
    }

    // Calculate total amount paid from the fetched installment records
    $totalAmountPaid = $fullypaidprocess->sum('amount');

    // Calculate balance
    $balance = $totalUnitPrice - $totalAmountPaid;

    return response()->json([
        'name' => $decryptedData['name'],
        'email' => $decryptedData['email'], // Use the decrypted email
        'phone_number' => $decryptedData['phone_number'], // Use the decrypted phone number
        'address' => $decryptedData['streetaddress'], // Use the decrypted address
        'unit_price' => $totalUnitPrice > 0 ? $totalUnitPrice : 'N/A', // Total unit price
        'amount' => $totalAmountPaid, // Total amount paid
        'balance' => $balance, // Calculate and return balance
        'installments' => $decryptedInstallments, // Include decrypted installment records
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