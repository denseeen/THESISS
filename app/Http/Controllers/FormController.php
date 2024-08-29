<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\AdminInfo;
use App\Models\Order;
use App\Models\PaymentService;
use App\Models\InstallmentPlan;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate and save the data
        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'streetaddress'   => 'nullable|string|max:255',
            'phone_number'    => 'nullable|string|max:15',
            'date_of_birth'   => 'nullable|date',
            'orderNumber'     => 'required|string|max:255',
            'unitName'        => 'nullable|string|max:255',
            'dateOrder'       => 'nullable|date',
            'unitprice'       => 'nullable|numeric',
            'unitDescription' => 'nullable|string',
            'installment'     => 'nullable|boolean',
            'fullypaid'       => 'nullable|boolean',
            'sixmonths'       => 'nullable|boolean',
            'twelvemonths'    => 'nullable|boolean',
            'eighteenmonths'  => 'nullable|boolean',
            // 'age'              => 'required|integer',
            // 'facebookAccount'  => 'nullable|string|max:255',,
            // 'gender'           => 'required|string|in:male,female,other',
            // // TELEPHONE NUMBER
        ]);

        // Set default values for checkboxes
        $installment = $request->input('installment', false) ? 1 : 0;
        $fullypaid   = $request->input('fullypaid', false) ? 1 : 0;

        // Handle the checkbox fields
        $twelvemonths   = $request->input('twelvemonths', false) ? 1 : 0;
        $sixmonths      = $request->input('sixmonths', false) ? 1 : 0;
        $eighteenmonths = $request->input('eighteenmonths', false) ? 1 : 0;

        // Save to the customer_info table
        $customerInfo = CustomerInfo::create([
            'name'          => $validatedData['name'],
            'email'         => $validatedData['email'],
            'streetaddress' => $validatedData['streetaddress'],
            // 'state'          => $validatedData['state'],
            // 'city'           => $validatedData['city'],
            'phone_number'   => $validatedData['phone_number'],
            'date_of_birth'  => $validatedData['date_of_birth']
        ]);

        // Save to the admin_info table
        $adminInfo = AdminInfo::create([
            'name'          => $validatedData['name'],
            'email'         => $validatedData['email'],
            'streetaddress' => $validatedData['streetaddress'],
            // 'state'      => $validatedData['state'],
            // 'city'       => $validatedData['city'],
            'phone_number'  => $validatedData['phone_number'],
            'date_of_birth' => $validatedData['date_of_birth']
        ]);

        // Save to the orders table
        $order = Order::create([
            'orderNumber'     => $validatedData['orderNumber'],
            'dateOrder'       => $validatedData['dateOrder'],
            'unitName'        => $validatedData['unitName'],
            'unitprice'       => $validatedData['unitprice'],
            'unitDescription' => $validatedData['unitDescription']
        ]);

        // Save to the payment_service table
        $paymentService = PaymentService::create([
            'fullypaid'   => $fullypaid,
            'installment' => $installment
        ]);

        // Save to the installment_plan table
        $installmentPlan = InstallmentPlan::create([
            'twelvemonths'   => $twelvemonths,
            'sixmonths'      => $sixmonths,
            'eighteenmonths' => $eighteenmonths
        ]);

        return redirect()->route('success.page');
    }
}
