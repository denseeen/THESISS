<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentService;

use App\Models\CustomerInfo;

use Illuminate\Support\Facades\DB;

class AdminInstallmentController extends Controller
{
    public function indexxx()
    {
//     // Fetch installment and fully paid records
//     $installments = DB::table('customer_info')
//         ->join('payment_service', 'customer_info.id', '=', 'payment_service.id')
//         ->where('payment_service.installment', 1)
//         ->where('payment_service.fullypaid', 0)
//         ->select('customer_info.*')
//         ->get();

//         $fullypaids = DB::table('customer_info')
//         ->join('payment_service', 'customer_info.id', '=', 'payment_service.id')
//         ->where('payment_service.fullypaid', 1)
//         ->where('payment_service.installment', 0)
//         ->select('customer_info.*')
//         ->get();    
//     // Pass data to the view
//     return view('about.adminnav.adinstallment', compact('installments'));
// }

// public function indexxxxx()
// {
//     $fullypaids = DB::table('customer_info')
//     ->join('payment_service', 'customer_info.id', '=', 'payment_service.id')
//     ->where('payment_service.fullypaid', 1)
//     ->where('payment_service.installment', 0)
//     ->select('customer_info.*')
//     ->get();

//     return view('about.adminnav.adfullypaid', compact('fullypaids'));
}
}
