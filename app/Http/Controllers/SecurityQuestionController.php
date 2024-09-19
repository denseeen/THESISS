<?php

namespace App\Http\Controllers;

use App\Models\SecurityQuestion;
use App\Models\PredefinedSecurityQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SecurityQuestionController extends Controller
{
    public function customer_security()
{
    return view('about.customernav.security');
}

public function admin_security()
{
    return view('about.adminnav.security');
}

    // Store the security questions and answers
    public function store(Request $request)
    {
       // Validate the request data
    $validated = $request->validate([
        'answer1' => 'required|string',
        'answer2' => 'required|string',
        'answer3' => 'required|string',
        'answer4' => 'required|string',
        'question_id1' => 'required|integer',
        'question_id2' => 'required|integer',
        'question_id3' => 'required|integer',
        'question_id4' => 'required|integer',
    ]);

    // Get the current authenticated user's ID
    $userId = Auth::id();

    try {
        // Insert each answer into the database
        SecurityQuestion::create([
            'user_id' => $userId,
            'predefined_question_id' => $validated['question_id1'],
            'answer' => $validated['answer1'],
        ]);

        SecurityQuestion::create([
            'user_id' => $userId,
            'predefined_question_id' => $validated['question_id2'],
            'answer' => $validated['answer2'],
        ]);

        SecurityQuestion::create([
            'user_id' => $userId,
            'predefined_question_id' => $validated['question_id3'],
            'answer' => $validated['answer3'],
        ]);

        SecurityQuestion::create([
            'user_id' => $userId,
            'predefined_question_id' => $validated['question_id4'],
            'answer' => $validated['answer4'],
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error('Error saving security questions: ' . $e->getMessage()); // Log the error for debugging
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
    }
    //forgot password

    // Show the password recovery form
    public function forgotpassword()
{
    return view('about.forgotpassword');
}

// Fetch the security question for a given email
public function getSecurityQuestion(Request $request)
{
    // Validate the email input
    $request->validate([
        'email' => 'required|email'
    ]);

    // Fetch the user by email
    $user = User::where('email', $request->input('email'))->first();
    
    if ($user) {
        // Fetch security questions associated with the user
        $securityQuestions = SecurityQuestion::where('user_id', $user->id)->get();

        // Check if user has security questions
        if ($securityQuestions->isNotEmpty()) {
            // Select a random security question
            $securityQuestion = $securityQuestions->random();

            // Return the question and its ID
            return response()->json([
                'question' => $securityQuestion->predefinedQuestion->question,
                'question_id' => $securityQuestion->predefined_question_id
            ]);
        } else {
            // No security questions found for the user
            return response()->json(['message' => 'No security questions found.'], 404);
        }
    }

    // User not found
    return response()->json(['message' => 'User not found.'], 404);
}

// Validate the security question answer
public function validateAnswer(Request $request)
{
     // Validate the request input
     $request->validate([
        'email' => 'required|email',
        'answer' => 'required|string',
        'question_id' => 'required|integer|exists:predefined_security_questions,id'
    ]);

    $email = $request->input('email');
    $answer = strtolower(trim($request->input('answer'))); // Normalize the input answer
    $questionId = $request->input('question_id');

    // Fetch the user by email
    $user = User::where('email', $email)->first();

    if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
    }

    // Fetch the security question based on the user ID and question ID
    $securityQuestion = SecurityQuestion::where('user_id', $user->id)
                                        ->where('predefined_question_id', $questionId)
                                        ->first();

    if (!$securityQuestion) {
        return response()->json(['status' => 'error', 'message' => 'Security question not found.'], 404);
    }

    // Compare the provided answer with the stored answer (case-insensitive)
    if (strtolower(trim($securityQuestion->answer)) === $answer) {
        // Answer is correct
        return response()->json(['status' => 'success', 'message' => 'Answer is correct.']);
    } else {
        // Incorrect answer
        return response()->json(['status' => 'error', 'message' => 'Incorrect answer.']);
    }
}


// Update the user's password
public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8'
    ]);

    $user = User::where('email', $request->input('email'))->first();
    if ($user) {
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}


    public function changeforgotpassword(){
        return view('about.successfulchange');
    }





    
}
