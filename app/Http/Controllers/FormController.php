<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate and save the data
        $validatedData = $request->validate([
            'lastName'        => 'required|string|max:255',
            'firstName'       => 'required|string|max:255',
            'middleName'      => 'nullable|string|max:255',
            'address'         => 'required|string|max:255',
            'dob'             => 'required|date',
            'age'             => 'required|integer',
            'mobileNumber'    => 'required|numeric',
            'facebookAccount' => 'nullable|string|max:255',
            'emailAddress'    => 'required|email',
            'gender'          => 'required|string|in:male,female,other',
        ]);
        return redirect()->route('success.page')->with('status', 'Form submitted successfully!');
    }
}
