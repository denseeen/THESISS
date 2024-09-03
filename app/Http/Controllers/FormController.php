<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CustomerInfo;
use App\Models\AdminInfo;
use App\Models\Order;
use App\Models\PaymentService;
use App\Models\InstallmentPlan;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate and save the data
        $validatedData = $request->validate([
            // Customer & Admin
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'streetaddress'    => 'nullable|string|max:255',
            'phone_number'     => 'nullable|string|max:15',
            'date_of_birth'    => 'nullable|date',
            'age'              => 'required|integer',
            'facebook'         => 'nullable|string|max:255',
            'gender'           => 'required|string|in:male,female,other',
            'telephone_number' => 'nullable|string|max:15',

            // Orders
            'orderNumber'     => 'required|string|max:255',
            'unitName'        => 'nullable|string|max:255',
            'dateOrder'       => 'nullable|date',
            'unitprice'       => 'nullable|numeric',
            'unitDescription' => 'nullable|string',

            //Payment Method & Installment Plan
            'installment'     => 'nullable|boolean',
            'fullypaid'       => 'nullable|boolean',
            'sixmonths'       => 'nullable|boolean',
            'twelvemonths'    => 'nullable|boolean',
            'eighteenmonths'  => 'nullable|boolean',

            //Users
            'name'       => 'required',
            'email'      => 'required|unique:users,email',
            'password'   => 'required',
            'user_roles' => 'required'
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
            'name'              => $validatedData['name'],
            'email'             => $validatedData['email'],
            'streetaddress'     => $validatedData['streetaddress'],
            'phone_number'      => $validatedData['phone_number'],
            'date_of_birth'     => $validatedData['date_of_birth'],
            'age'               => $validatedData['age'],
            'facebook'          => $validatedData['facebook'],
            'gender'            => $validatedData['gender'],
            'telephone_number'  => $validatedData['telephone_number'],
        ]);

        // Save to the admin_info table
        $adminInfo = AdminInfo::create([
            'name'              => $validatedData['name'],
            'email'             => $validatedData['email'],
            'streetaddress'     => $validatedData['streetaddress'],
            'phone_number'      => $validatedData['phone_number'],
            'date_of_birth'     => $validatedData['date_of_birth'],
            'age'               => $validatedData['age'],
            'facebook'          => $validatedData['facebook'],
            'gender'            => $validatedData['gender'],
            'telephone_number'  => $validatedData['telephone_number'],
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

        // Save to the users table
        $save = User::create([ 
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
            'user_roles' => $request->input('user_roles')
        ]);

        return redirect()->route('success.page');
    }

    public function LoginEntry(Request $request)
              {
                  // Validate the login credentials
                  $credentials = $request->validate([
                      'email' => ['required', 'email'],
                      'password' => ['required'],
                  ]);
              
                  // Attempt to authenticate the user with the provided credentials
                  if (Auth::attempt($credentials)) {
                      // Retrieve the authenticated user
                      $user = Auth::user();
              
                      // Check user role and return the appropriate view
                      switch ($user->user_roles) {
                          case '1':
                              // Admin view
                              return view('about.adminnav.addashboard', ['user' => $user]);
              
                          case '2':
                              // Customer view
                              return view('about.customernav.cusdashboard', ['user' => $user]);
              
                          default:
                              // Handle other roles or redirect with an error if the role is unauthorized
                              return redirect()->route('login')->withErrors(['email' => 'Unauthorized role']);
                      }
                  }
              
                  // If authentication fails, return back with an error
                  return back()->withErrors([
                      'email' => 'The provided credentials do not match our records.',
                  ])->onlyInput('email');
              }
}
