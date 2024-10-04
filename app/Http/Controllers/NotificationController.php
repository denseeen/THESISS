<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\CustomerInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;


class NotificationController extends Controller
{
  
    public function sendMessage(Request $request)
{
    $validated = $request->validate([
        'recipientId' => 'required|exists:customer_info,id',
        'message' => 'required|string',
    ]);

    try {
        // Ensure the sender is an admin
        if (!Auth::check() || Auth::user()->user_roles !== 1) {
            return response()->json(['success' => false, 'message' => 'Unauthorized user.'], 403);
        }

        // Create the message
        Message::create([
            'recipient_id' => $validated['recipientId'],
            'content' => $validated['message'],
            'sender_id' => Auth::user()->id, // Assuming the admin is logged in
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Log the exception if needed
        \Log::error('Message sending failed for user ' . (Auth::check() ? Auth::user()->id : 'guest') . ': ' . $e->getMessage());

        return response()->json(['success' => false, 'message' => 'Failed to send message.'], 500);
    }
}


public function fetchMessages()
{
    // Get the current authenticated user
    $user = Auth::user();
    
    // Find the customer's info based on user ID
    $customerInfo = DB::table('customer_info')->where('user_id', $user->id)->first();
    
    if ($customerInfo) {
        // Fetch only unread messages for the current user
        $messages = DB::table('messages')
            ->join('admin_info', 'messages.sender_id', '=', 'admin_info.id')
            ->where('messages.recipient_id', $customerInfo->id) // Use customer's ID
            ->where('messages.is_read', false) // Only get unread messages
            ->select('messages.*', 'admin_info.name as sender_name') // Select the necessary fields
            ->orderBy('messages.created_at', 'desc')
            ->get();

        return response()->json($messages);
    }

    return response()->json([]); // Return an empty array if no customer info
}


        public function deleteMessage($id)
        {
                $message = Message::find($id); // Find the message by ID
                
                if ($message) {
                    $message->delete(); // Delete the message from the database
                    return response()->json(['success' => true], 204); // Return a success response
                }
                
                return response()->json(['error' => 'Message not found'], 404);
            
        }











}