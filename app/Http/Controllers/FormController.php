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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
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
            // 'customer_id'      => 'required|exists:customer_info,id',
 
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
            'name'       => Crypt::encryptString($request->input('name')),
            'email'      => Crypt::encryptString($request->input('email')),  // Encrypt email
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
                'email'      => Crypt::encryptString($request->input('email')),  // Encrypt email
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
                'name'              => Crypt::encryptString($request->input('name')),
                'email'             => Crypt::encryptString($request->input('email')),  // Encrypt email
                'streetaddress'     => Crypt::encryptString($request->input('streetaddress')),
                'phone_number'      => Crypt::encryptString($request->input('phone_number')),
                'date_of_birth'     => $validatedData['date_of_birth'],
                'age'               => $validatedData['age'],
                'facebook'          => Crypt::encryptString($request->input('facebook')),
                'gender'            => Crypt::encryptString($request->input('gender')),
                'telephone_number'  => Crypt::encryptString($request->input('telephone_number')),
                // 'customer_id'       => $customerInfo->id,
            ]);
 
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
 
        return redirect()->route('success.page');
    }
 
    public function LoginEntry(Request $request)
    {
        // Validate the login credentials to ensure they meet the required format
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Email is required and must be a valid email format
            'password' => ['required'], // Password is required
        ]);
   
        // Fetch all users
        $users = DB::table('users')->get();
   
        // Variable to hold the authenticated user
        $authenticatedUser = null;
   
        // Loop through each user and check if their email matches
        foreach ($users as $user) {
            // Initialize a variable to store the email to check
            $emailToCheck = $user->email;
   
            // Attempt to decrypt the email
            try {
                // Attempt decryption
                $decryptedEmail = Crypt::decryptString($user->email);
                // If successful, use the decrypted email for checking
                $emailToCheck = $decryptedEmail;
            } catch (DecryptException $e) {
                // If decryption fails, this indicates that the email is in plain text
                // We can ignore the error and continue
            }
   
            // Check if the email matches and password is correct
            if ($emailToCheck === $credentials['email'] && Hash::check($credentials['password'], $user->password)) {
                // If a match is found, set the authenticated user
                $authenticatedUser = $user;
                break; // Exit the loop once we find the user
            }
        }
   
        // Check if an authenticated user was found
        if ($authenticatedUser) {
            // Log in the user using their ID
            Auth::loginUsingId($authenticatedUser->id);
   
            // Check the user's role to determine which view to return
            switch ($authenticatedUser->user_roles) {
                case '1':
                    // If the user is an admin (role 1), return the admin dashboard view
                    return view('about.adminnav.addashboard', ['user' => $authenticatedUser]);
   
                case '2':
                    // If the user is a customer (role 2)
   
                    // Fetch customer information from the customer_info table
                    $customerInfo = DB::table('customer_info')
                        ->where('email', $authenticatedUser->email) // Use the authenticated user's email
                        ->first(); // Fetch the first matching record
   
                    // Customer view; this can be modified to include $customerInfo if needed
                    return view('about.customernav.cusdashboard', ['user' => $authenticatedUser]);
   
                default:
                    // Handle other roles or redirect with an error if the role is unauthorized
                    return redirect()->route('login')->withErrors(['email' => 'Unauthorized role']);
            }
        }
   
        // If authentication fails, return back to the login form with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.', // Error message if credentials are invalid
        ])->onlyInput('email'); // Only retain the email input for user convenience
    }
   
   
 
}