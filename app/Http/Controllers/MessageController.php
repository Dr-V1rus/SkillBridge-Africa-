<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Application $application)
    {
        $messages = Message::where('application_id', $application->id)
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('messages.index', compact('application', 'messages'));
    }
    
    public function store(Request $request, Application $application)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        $receiverId = Auth::id() === $application->student_id 
            ? $application->internship->business_id 
            : $application->student_id;
        
        $message = Message::create([
            'application_id' => $application->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at->diffForHumans(),
                'sender_id' => $message->sender_id,
                'sender_name' => Auth::user()->name,
            ]
        ]);
    }
    
    public function getMessages(Application $application)
    {
        $messages = Message::where('application_id', $application->id)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();
            
        Message::where('application_id', $application->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        return response()->json($messages);
    }
    
    public function getUnreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
            
        return response()->json(['count' => $count]);
    }
}
