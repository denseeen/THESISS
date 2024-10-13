<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\InstallmentProcess;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
   
  // Search Customer Method
public function showEditForm($id)
{
    $customer = CustomerInfo::find($id);

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    return response()->json($customer);
}

// edit customer info 
public function updateCustomer(Request $request)
{
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

    $customer = CustomerInfo::find($request->id);
    
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    $customer->update($validatedData);

    return response()->json(['success' => 'Customer updated successfully!']);
}


// for both customer and installment_process search
public function searchCustomer(Request $request)
{
    $name = $request->query('name');
    $customers = CustomerInfo::where('name', 'LIKE', '%' . $name . '%')->get();
    
    return response()->json($customers);
}

// update button on installment
public function updateInstallment(Request $request, $id)
{
    $validatedData = $request->validate([
        'payment_method' => 'required|string|max:15',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'status' => 'required|string|max:15',
        'violation' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:255',
    ]);

    $installment = InstallmentProcess::find($id);  // Fetch the correct installment by its ID

    if (!$installment) {
        return response()->json(['error' => 'Installment process not found'], 404);
    }

    $installment->update($validatedData);

    return response()->json(['success' => 'Installment updated successfully!']);
}



// public function getInstallments($customerId)
// {
//     $installments = InstallmentProcess::where('customer_id', $customerId)->get();
//     return response()->json($installments);
// }


// public function getInstallment($installmentId)
// {
//     $installment = InstallmentProcess::find($installmentId);
//     if (!$installment) {
//         return response()->json(['error' => 'Installment not found'], 404);
//     }
//     return response()->json($installment);
// }




}
