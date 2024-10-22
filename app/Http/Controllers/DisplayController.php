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

// customer profile decrypted
public function user_infos()
{
    $userId = Auth::id(); // Get the current user's ID

    // Fetch user info and related customer data
    $infos = DB::table('customer_info')
        ->join('users', 'customer_info.user_id', '=', 'users.id')
        ->select('customer_info.*', 'users.email') // Select fields you need, including email from users table
        ->where('customer_info.user_id', $userId)
        ->first();

    // Check if user info is found
    if ($infos) {
        // Decrypt fields with error handling
        $fieldsToDecrypt = ['name', 'facebook', 'streetaddress', 'phone_number', 'gender', 'telephone_number', 'email'];

        foreach ($fieldsToDecrypt as $field) {
            try {
                if (isset($infos->$field)) {
                    // Attempt to decrypt each field
                    $infos->$field = Crypt::decryptString($infos->$field);
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Log the error
                \Log::error("Decryption failed for field '{$field}' of user ID: {$userId}. Error: " . $e->getMessage());
                // Optionally assign a placeholder for fields that fail to decrypt
                $infos->$field = 'Decryption Failed';
            }
        }
    }

    // Return the view with the decrypted infos
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
            // Optionally, you could set a placeholder if desired
            // $customer->name = 'Decryption Failed'; // Uncomment if needed
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
    $fieldsToCheck = ['email', 'phone_number', 'streetaddress','name']; // Add any other fields you want to check

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






function fetchPaymentSchedule() {
    const loadingIndicator = document.getElementById('loading');
    loadingIndicator.style.display = 'block';

    fetch('/payment-schedule/customer')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            loadingIndicator.style.display = 'none';

            const tableBody = document.getElementById('payment-schedule-table-body');
            tableBody.innerHTML = '';

            let totalOverdue = 0; // Initialize total overdue
            let currentMonthlyBill = 0; // Initialize current monthly bill
            let totalBalance = 0; // Initialize total balance
            let firstNotPaidAmount = null; // Initialize the first not paid amount

            data.payment_schedule.forEach(payment => {
                const row = document.createElement('tr');
                let statusBadge = '';

                const paymentScheduleDate = new Date(payment.date);
                const today = new Date();
                const actualPaymentDate = payment.actual_payment_date ? new Date(payment.actual_payment_date) : null;

                let amount = parseFloat(payment.amount.toString().replace(/,/g, '')); // Remove commas and convert to float
                const originalAmount = amount; // Keep the original amount for display

                // Payment status logic
                if (payment.status === 'paid') {
                    statusBadge = '<span class="badge" style="background-color: #28a745; color: white; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Paid</span>';
                } else if (actualPaymentDate && actualPaymentDate > paymentScheduleDate && payment.status === 'paid late') {
                    statusBadge = '<span class="badge" style="background-color: #ffc107; color: black; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Paid Late</span>';
                } else if (payment.status === 'paid in advance') {
                    statusBadge = '<span class="badge" style="background-color: green; color: white; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Paid In Advance</span>';
                } else if (today > paymentScheduleDate) {
                    // Check if the payment is overdue
                    statusBadge = '<span class="badge" style="background-color: #dc3545; color: white; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Overdue</span>';
                    const penaltyAmount = originalAmount * 0.10; // Calculate 10% penalty
                    amount += penaltyAmount; // Add penalty to amount for display
                    totalOverdue += originalAmount; // Add the original overdue amount to total overdue
                } else {
                    // Payment is not paid yet
                    statusBadge = '<span class="badge" style="background-color: white; color: black; padding: 0.5em 1em; border-radius: 0.5em; font-weight: bold;">Not Paid</span>';
                    if (firstNotPaidAmount === null) {
                        firstNotPaidAmount = payment.amount; // Store the first not paid amount
                    }
                    amount -= 100; // Deduct the rebate from the amount for future due
                }

                // Format payment date for display
                const formattedPaymentDate = paymentScheduleDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                row.innerHTML = `
                    <td>${formattedPaymentDate}</td>
                    <td>₱${amount.toFixed(2)}</td>
                    <td>${statusBadge}</td>
                `;
                tableBody.appendChild(row);

                // Add amount to current monthly bill only for overdue payments (including penalties)
                if (today > paymentScheduleDate) {
                    currentMonthlyBill += originalAmount; // Include the original overdue amount for the current bill
                }

                // Add the adjusted amount to total balance
                totalBalance += amount; // Sum the adjusted amounts for total balance calculation
            });

            // Update billing card values
            document.getElementById('current-monthly-bill').textContent = `₱${(totalOverdue * 1.1).toFixed(2)}`; // Total overdue with penalties
            document.getElementById('next-payment-due').textContent = data.nextPaymentDue ? data.nextPaymentDue : 'N/A';

            // Update balance to reflect total amounts
            document.querySelector('#balance .h3').textContent = `Pesos: ${totalBalance.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
            
            document.getElementById('unit-price').textContent = `₱${(data.unit_price).toFixed(2)}`; // No need to multiply unit price by 100
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            loadingIndicator.style.display = 'none';
        });
}

fetchPaymentSchedule();




let foundNextDue = false; // Flag to find the next unpaid due date


if (!foundNextDue) {
                        currentMonthlyBill += originalAmount; // Add the unpaid amount for the current monthly bill
                        foundNextDue = true; // Set the flag to true to prevent adding future unpaid amounts
                    }