<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\InstallmentProcess;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
 
use Illuminate\Http\Request;
 
class AdminDashboardController extends Controller
{
   
  // decrypt data and
  public function showEditForm($id)
  {
      // Find the customer by ID
      $customer = CustomerInfo::find($id);
 
      if (!$customer) {
          return response()->json(['error' => 'Customer not found'], 404);
      }
 
      // Decrypt the customer data
      try {
          $customer->name = Crypt::decryptString($customer->name);
          $customer->email = Crypt::decryptString($customer->email);
          $customer->phone_number = Crypt::decryptString($customer->phone_number);
          $customer->streetaddress = Crypt::decryptString($customer->streetaddress);
          $customer->facebook = Crypt::decryptString($customer->facebook);
          $customer->gender = Crypt::decryptString($customer->gender);
          $customer->telephone_number = Crypt::decryptString($customer->telephone_number);
      } catch (DecryptException $e) {
          return response()->json(['error' => 'Decryption failed'], 500);
      }
 
      // Return the decrypted customer data
      return response()->json($customer);
  }
 
// edit customer info
public function updateCustomer(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:20',
        'streetaddress' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer|min:0',
        'facebook' => 'nullable|max:255',
        'gender' => 'required|string|max:10',
        'telephone_number' => 'nullable|string|max:20',
    ]);
 
    // Find the customer by ID
    $customer = CustomerInfo::find($request->id);
   
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }
 
    // Encrypt new values before updating
    try {
        $customer->name = Crypt::encryptString($validatedData['name']);
        $customer->email = Crypt::encryptString($validatedData['email']);
        $customer->phone_number = Crypt::encryptString($validatedData['phone_number']);
        $customer->streetaddress = Crypt::encryptString($validatedData['streetaddress']);
        $customer->facebook = Crypt::encryptString($validatedData['facebook']);
        $customer->gender = Crypt::encryptString($validatedData['gender']);
        $customer->telephone_number = Crypt::encryptString($validatedData['telephone_number']);
     
 
        // Save the updated customer data
        $customer->save();
 
        return response()->json(['success' => 'Customer updated successfully!']);
    } catch (EncryptException $e) {
        return response()->json(['error' => 'Encryption failed during update'], 500);
    }
}
 
 
 
// for both customer and installment_process search
public function searchCustomer(Request $request)
{
    // Fetch all customers
    $customers = CustomerInfo::all();
 
    // Prepare an array to hold decrypted customer data
    $decryptedCustomers = [];
 
    // Decrypt customer data
    foreach ($customers as $customer) {
        $decryptedCustomer = [
            'id' => $customer->id,
            'name' => null, // Placeholder for decrypted name
            'email' => null, // Placeholder for decrypted email
            'phone_number' => null, // Placeholder for decrypted phone number
        ];
 
        // Attempt to decrypt the name
        try {
            $decryptedCustomer['name'] = Crypt::decryptString($customer->name);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, use the original encrypted name
            $decryptedCustomer['name'] = $customer->name;
        }
 
        // Attempt to decrypt the email
        try {
            $decryptedCustomer['email'] = Crypt::decryptString($customer->email);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, use the original encrypted email
            $decryptedCustomer['email'] = $customer->email;
        }
 
        // Attempt to decrypt the phone number
        try {
            $decryptedCustomer['phone_number'] = Crypt::decryptString($customer->phone_number);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // If decryption fails, use the original encrypted phone number
            $decryptedCustomer['phone_number'] = $customer->phone_number;
        }
 
        $decryptedCustomers[] = $decryptedCustomer; // Store decrypted (or original) customer data
    }
 
    // Get the search name from the query parameter
    $name = $request->query('name');
 
    // Filter decrypted customers based on the search criteria
    $filteredCustomers = array_filter($decryptedCustomers, function ($customer) use ($name) {
        return stripos($customer['name'], $name) !== false; // Case-insensitive search
    });
 
    // Return filtered results as JSON
    return response()->json(array_values($filteredCustomers));
}
 


public function updateInstallment(Request $request, $installmentId)
{
    // Validate the input from the form
    $validatedData = $request->validate([
        'payment_method' => 'required|string|max:15',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'status' => 'required|string|max:15',
        'violation' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:255',
    ]);

    // Find the installment by ID
    $installment = InstallmentProcess::find($installmentId);

    // Check if the installment exists
    if (!$installment) {
        return response()->json(['error' => 'Installment process not found'], 404);
    }

    // Encrypt specific fields before updating
    $installment->payment_method = Crypt::encryptString($request->input('payment_method')); 
    $installment->amount = $validatedData['amount'];
    $installment->date = $validatedData['date'];
    $installment->status = Crypt::encryptString($request->input('status')); 
    $installment->violation = Crypt::encryptString($request->input('violation'));
    $installment->comment = Crypt::encryptString($request->input('comment'));

    // Save the updated installment
    $installment->save();

    // Return only the success message
    return response()->json(['message' => 'Successfully updated']);
}


public function getInstallments($customerId)
{
    $installments = InstallmentProcess::where('customer_id', $customerId)->get();

    // Decrypt relevant fields for readability
    foreach ($installments as $installment) {
        $installment->payment_method = $this->decryptField($installment->payment_method);
        $installment->status = $this->decryptField($installment->status);
        $installment->violation = $this->decryptField($installment->violation);
        $installment->comment = $this->decryptField($installment->comment);
    }

    return response()->json($installments);
}

private function decryptField($field)
{
    try {
        return Crypt::decryptString($field);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return $field; // Return original if decryption fails
    }
}

public function getInstallment($installmentId)
{
    $installment = InstallmentProcess::find($installmentId);
    
    if (!$installment) {
        return response()->json(['error' => 'Installment not found'], 404);
    }

    // Decrypt fields for readability
    $installment->payment_method = $this->decryptField($installment->payment_method);
    $installment->status = $this->decryptField($installment->status);
    $installment->violation = $this->decryptField($installment->violation);
    $installment->comment = $this->decryptField($installment->comment);
    $installment->amount = $installment->amount; // Assuming amount is stored as plain
    $installment->date = $installment->date; // Assuming date is stored as plain

    return response()->json($installment);
}

 
 
 
 
}