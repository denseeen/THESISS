<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInfo;
use App\Models\AdminInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DisplayController extends Controller
{


public function user_infos()
{
    $userId = Auth::id(); // Get the current user's ID
    $infos = DB::table('customer_info')->where('id', $userId)->first();
    return view('about.customernav.cusprofile')->with('infos', $infos); 
}

public function user_infos_admin()
{
    $userId = Auth::id(); // Get the current user's ID
    $info = DB::table('admin_info')->where('id', $userId)->first();
    return view('about.adminnav.adprofile')->with('info', $info); 
}


}







?>
