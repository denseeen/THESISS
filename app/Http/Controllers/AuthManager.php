<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class AuthManager extends Controller
{

    // public function Def() {
    //     return view('about.layout');
    //     }

      public function home() {
          return view('about.layout'); 
        }

      public function Resgistration(){
          return view('about.registration');
       }

      public function admin_profile(){
          return view('about.adminnav.adprofile');
       }

      public function admin_dashboard(){
          return view('about.adminnav.addashboard');
       }

      public function admin_installment(){
          return view('about.adminnav.adinstallment');
       }

      public function admin_fullypaid(){
          return view('about.adminnav.adfullypaid');
       }

      public function admin_archived(){
          return view('about.adminnav.adarchived');
       }

      public function admin_request(){
          return view('about.adminnav.adrequest');
       }

      public function customer_profile(){
          return view('about.customernav.cusprofile');
       }
    
      public function customer_dashboard(){
          return view('about.customernav.cusdashboard');
       }
    
      public function customer_perchasehistory(){
          return view('about.customernav.cuspurchasehistory');
       }

       public function customerUI(){
        return view('about.customer');
        
        }

      public function adminUI(){
      return view('about.admin');
        }


    public function Saved(Request $request){
              $request->validate([
                'name'=> 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'user_roles' => 'required'
            ]);

              $save = User::create([ 
                  'name' => $request->input('name'),
                  'email' => $request->input('email'),
                  'password' => Hash::make($request->input('password')),
                  'user_roles' => $request->input('user_roles')
                ]);

                return view('about.registration');     
           }
  
          public function Login(){
          return view('about.login');
          }

//           public function LoginEntry(Request $request)
//               {
//                   // Validate the login credentials
//                   $credentials = $request->validate([
//                       'email' => ['required', 'email'],
//                       'password' => ['required'],
//                   ]);
              
//                   // Attempt to authenticate the user with the provided credentials
//                   if (Auth::attempt($credentials)) {
//                       // Retrieve the authenticated user
//                       $user = Auth::user();
              
//                       // Check user role and return the appropriate view
//                       switch ($user->user_roles) {
//                           case '1':
//                               // Admin view
//                               return view('about.adminnav.addashboard', ['user' => $user]);
              
//                           case '2':
//                               // Customer view
//                               return view('about.customernav.cusdashboard', ['user' => $user]);
              
//                           default:
//                               // Handle other roles or redirect with an error if the role is unauthorized
//                               return redirect()->route('login')->withErrors(['email' => 'Unauthorized role']);
//                       }
//                   }
              
                  // If authentication fails, return back with an error
//                   return back()->withErrors([
//                       'email' => 'The provided credentials do not match our records.',
//                   ])->onlyInput('email');
//               }

              public function showProfile()
                    {
                        $user = Auth::user();
                        $maskedPassword = str_repeat('*', strlen($user->password));

                        return view('profile', ['user' => $user, 'maskedPassword' => $maskedPassword]);
                    }

                    public function changePassword(Request $request)
                        {
                            // Validate the input
                            $validated = $request->validate([
                                'old_password' => 'required',
                                'new_password' => 'required|min:8|confirmed',
                            ]);

                            $user = Auth::user();

                            // Check if the old password matches
                            if (!Hash::check($request->old_password, $user->password)) {
                                return response()->json(['status' => 'error', 'message' => 'The old password is incorrect'], 400);
                            }

                            // Update the password
                            $user->password = Hash::make($request->new_password);
                            $user->save();

                            return response()->json(['status' => 'success', 'message' => 'Password changed successfully!']);
                        }


                             // Validate the uploaded file
                        public function upload(Request $request)
                        {
                            $request->validate([
                                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
                            ]);
                        
                            if ($request->hasFile('avatar')) {
                                // Generate a unique filename using the user's ID and the current timestamp
                                $filename = Auth()->id().'_'.time().'.'.$request->avatar->getClientOriginalExtension();
                                
                                // Debugging output
                                \Log::info('Uploading avatar for user ID: ' . Auth()->id() . ' with filename: ' . $filename);
                        
                                // Store the file in the 'public/images' directory
                                $request->avatar->storeAs('images', $filename, 'public');
                        
                                // Debugging output
                                \Log::info('Avatar stored successfully in public/images directory.');
                        
                                // Update the user's avatar in the database
                                Auth()->user()->update(['avatar' => $filename]);
                        
                                // Return a JSON response with the success status and the new avatar path
                                // return response()->json(['success' => true, 'avatarPath' => $filename]);
                                return redirect()->back()->with('success', 'Avatar uploaded successfully.');
                            }
                        
                            // Return a JSON response indicating the failure of the upload process
                            return response()->json(['success' => false, 'message' => 'Failed to upload avatar.']);
                        }


                      

                    

                        
                            


        
                            
                            
                        
                        
                  
                       


                        




            


                        










