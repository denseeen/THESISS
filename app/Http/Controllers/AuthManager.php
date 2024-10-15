<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\CustomerInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class AuthManager extends Controller
{


      public function home() {
          return view('about.layout'); 
        }

      public function Resgistration(){
          return view('about.registration');
       }


    //admin view address
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

       public function admin_edit(){
        return view('about.adminnav.adEdit');
     }


    public function customer_perchasehistory(){
        
        return view('about.customernav.cuspurchasehistory');
     }
    

     // Validate the uploaded file -profile pic
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

                // admin and customer changePassword
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
       
            //    notificationn bell         
    public function customer_dashboard()
            {
                        // Get the current authenticated user
                        $user = Auth::user();
                
                        // Find the customer's info based on user ID
                        $customerInfo = DB::table('customer_info')->where('user_id', $user->id)->first();
                        
                        if ($customerInfo) {
                            // Use a join to get messages with sender's name
                            $messages = DB::table('messages')
                                ->join('admin_info', 'messages.sender_id', '=', 'admin_info.id')
                                ->where('messages.recipient_id', $customerInfo->id) // Use customer's ID
                                ->where('messages.is_read', false) // Only get unread messages
                                ->select('messages.*', 'admin_info.name as sender_name') // Select the necessary fields
                                ->orderBy('messages.created_at', 'desc')
                                ->get();
        
                    
                    // Pass the messages to the view
                    return view('about.customernav.cusdashboard', compact('messages'));
                }

                // Return an empty collection if no messages
                return view('about.customernav.cusdashboard', ['messages' => collect()]);
            }

    

  //customer view address
      public function customer_profile(){
          return view('about.customernav.cusprofile');
       }


            // public function Def() {
            // return view('about.layout');
            // }
    
        //old design
        //   public function customerUI() 
        //   { 
        //     return view('about.customer');
        //   }
        //   public function adminUI()
        //   {
        //     return view('about.admin');
        //   }

        //old login
        // public function Saved(Request $request){
        //     $request->validate([
        //       'name'=> 'required',
        //       'email' => 'required|unique:users,email',
        //       'password' => 'required',
        //       'user_roles' => 'required'
        //   ]);

        //     $save = User::create([ 
        //         'name' => $request->input('name'),
        //         'email' => $request->input('email'),
        //         'password' => Hash::make($request->input('password')),
        //         'user_roles' => $request->input('user_roles'),
        //         'dark_mode'  => false // explicitly set dark_mode to false (or true based on logic)
        //       ]);

        //       return view('about.registration');     
        //  }

        // public function Login(){
        // return view('about.login');
        // }



        
    // public function user_infos()
    // {

    //     $infos = DB::table('customer_info')->select('id','gender','facebook','date_of_birth','telephone_number','phone_number','streetaddress')->get();
                     
    //         return view('about.customernav.cusprofile')->with('infos', $infos);
    // }     



    
      

     //   public function customer_security(){
     //   return view('about.customernav.security');
     //           }

     //   public function forgotpassword(){
     //   return view('about.forgotpassword');

     //         }

     // for all kind of user but only for user table     
     // public function showProfile()
     //  {
     //     $user = Auth::user();
     //     $maskedPassword = str_repeat('*', strlen($user->password));

     //     return view('profile', ['user' => $user, 'maskedPassword' => $maskedPassword]);
     //  }



     
//     public function Saved(Request $request){
//               $request->validate([
//                 'name'=> 'required',
//                 'email' => 'required|unique:users,email',
//                 'password' => 'required',
//                 'user_roles' => 'required'
//             ]);

//               $save = User::create([ 
//                   'name' => $request->input('name'),
//                   'email' => $request->input('email'),
//                   'password' => Hash::make($request->input('password')),
//                   'user_roles' => $request->input('user_roles'),
//                   'dark_mode'  => false
//                 ]);

//                 return view('about.registration');     
//            }
  
//           public function Login(){
//           return view('about.login');
//           }


//                 // for all kind of user but only for user table
              
              
//                 public function showProfile()
//                     {
//                         $user = Auth::user();
//                         $maskedPassword = str_repeat('*', strlen($user->password));




}

                
            


                        










