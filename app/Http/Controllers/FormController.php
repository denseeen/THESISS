<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use App\Models\AdminInfo;
use App\Models\Order;
use App\Models\Notifications;
use App\Models\PaymentService;
use App\Models\InstallmentPlan;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Correct DB facade import
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
            'streetaddress'    => 'nullable|string|max:255',
            'phone_number'     => 'nullable|string|max:255',
            'email'            => 'required|string|email|max:255',
            'date_of_birth'    => 'nullable|date',
            'age'              => 'required|integer',
            'facebook'         => 'nullable|string|max:255',
            'gender'           => 'required|string|in:male,female,other',
            'telephone_number' => 'nullable|string|max:15',

            // Orders
            'orderNumber'     => 'nullable|string|max:255',
            'unitName'        => 'nullable|string|max:255',
            'dateOrder'       => 'nullable|date',
            'unitprice'       => 'nullable|numeric',
            'unitDescription' => 'nullable|string',

            // Payment Method & Installment Plan
            'installment'     => 'nullable|integer',
            'fullypaid'       => 'nullable|integer',
            'sixmonths'       => 'nullable|integer',
            'twelvemonths'    => 'nullable|integer',
            'eighteenmonths'  => 'nullable|integer',

            'user_roles'      => 'required|integer'
        ]);

        // Set default values for checkboxes
        $installment = $request->input('installment', false) ? 1 : 0;
        $fullypaid   = $request->input('fullypaid', false) ? 1 : 0;
        $twelvemonths   = $request->input('twelvemonths', false) ? 1 : 0;
        $sixmonths      = $request->input('sixmonths', false) ? 1 : 0;
        $eighteenmonths = $request->input('eighteenmonths', false) ? 1 : 0;

        // Save to the users table
        $save = User::create([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
            'user_roles' => $validatedData['user_roles'],
            'dark_mode'  => false
        ]);

        // Save to the appropriate info tables
        if ($validatedData['user_roles'] == 1) {
            // Save to the admin_info table
            AdminInfo::create([
                'user_id'           => $save->id,
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
        } elseif ($validatedData['user_roles'] == 2) {
            // Save to the customer_info table
            $customerInfo = CustomerInfo::create([
                'user_id'           => $save->id,
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

            if ($customerInfo) {
                // Save to the orders table
                Order::create([
                    'customer_id'     => $customerInfo->id,
                    'orderNumber'     => $validatedData['orderNumber'],
                    'dateOrder'       => $validatedData['dateOrder'],
                    'unitName'        => $validatedData['unitName'],
                    'unitprice'       => $validatedData['unitprice'],
                    'unitDescription' => $validatedData['unitDescription']
                ]);

                // Save to the payment_service table
                PaymentService::create([
                    'customer_id'    => $customerInfo->id,
                    'fullypaid'      => $fullypaid,
                    'installment'    => $installment
                ]);

                // Save to the installment_plan table
                InstallmentPlan::create([
                    'customer_id'    => $customerInfo->id,
                    'twelvemonths'   => $twelvemonths,
                    'sixmonths'      => $sixmonths,
                    'eighteenmonths' => $eighteenmonths
                ]);
            }
        }

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
                   
                // Fetch customer information from the customer_info table
                $customerInfo = DB::table('customer_info')
                ->where('email', $user->email) // Use the authenticated user's email
                ->first();

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
