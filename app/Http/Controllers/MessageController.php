<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    public function index(Request $request){
        // return view
        $user = Auth::user();
        
        return view('messages.latestMessage');
        
    }
    //send message
    public function send(Request $request,$id){
        $message = new Message();
        $message->sender_id = $request->user()->id;
        $message->conversation_id = $id;
        $message->body = $request->body;
        $message->save();
        return redirect()->back();
    }
    
    
    // make a new conversation 
    public function createCoversation(Request $request){
        // check if conversation exist
        $conversation = Conversation::where('participants', $request->user()->id)
            ->where('participants', $request->receiver_id)->first();
        if($conversation){
            return redirect()->back();
        }
        // create new conversation
        $conversation = new Conversation();
        $conversation->sender_id = $request->user()->id;
        $conversation->receiver_id = $request->receiver_id;
        $conversation->save();
        return redirect()->back();
    }

    // api calls
    // get conversations
    public function getConversations(Request $request,$id){
        // get conversations where user is sender or receiver
        $conversations = Conversation::where('sender_id', $id)
            ->orWhere('receiver_id', $id)->get();
        // get last message for each conversation
        foreach ($conversations as $conversation) {
            $lastMessage = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'desc')->first();
            
            // if the sender_id is the current user id query the receiver_id
            if($conversation->sender_id == $id){
                $user = User::find($conversation->receiver_id);
            }else{
                $user = User::find($conversation->sender_id);
            }
            $conversation->lastMessage = $lastMessage;
            $conversation->user = $user;
        };

        return response()->json($conversations);
    }
    // get messages in descending order
    public function getMessages(Request $request, $id){
        // get last 20 messages where conversation id is equal to the id

        $messages = Message::where('conversation_id', $id)->orderBy('created_at')->take(20)->get();
        return response()->json($messages);
    }

    // search conversations with first name as input
    public function searchConversations(Request $request){
        $conversations = Conversation::where('participants', $request->user()->id)
            ->where('participants', $request->receiver_id)->get();
        return response()->json($conversations);
    }
    

}


        

