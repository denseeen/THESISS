<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    public function Def(){
        return view('welcome');
        }

        public function home(){
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

    public function LoginEntry(Request $request){
          $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
         ]);

       if (Auth::attempt($credentials)) {
        // $request->session()->regenerate();
       
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
                Auth::login($user);
        $userrole = $user->user_roles;
         if( $userrole =='1'){
            return view ('about.admin');
        }else{
            return view ('about.customer');

        } 
  
        }    
  
        return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
       ])->onlyInput('email');
         
      }


        public function customerUI(){
          return view('about.customer');
          }

        public function adminUI(){
        return view('about.admin');
        
       
        

       }
}









