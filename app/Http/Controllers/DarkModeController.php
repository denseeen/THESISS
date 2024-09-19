<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DarkModeController extends Controller
{
    public function updateDarkMode(Request $request) {
        $user = Auth::user();
        $user->dark_mode = $request->input('dark_mode');
        $user->save();
    
        return response()->json(['success' => true]);
    }
    
}
   






?>