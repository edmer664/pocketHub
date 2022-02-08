<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;

class MessageController extends Controller
{
    //send message
    public function send(Request $request){
        $message = new Message();
        $message->sender_id = $request->user()->id;
        $message->conversation_id = $request->conversation_id;
        $message->body = $request->body;
        $message->save();
        return redirect()->back();
    }

    // show all messages
    public function show(Request $request, $id){
        // verify user if belongs to conversation
        $conversation = Conversation::find($id);
        if(!in_array($request->user()->id, $conversation->participants)){
            return redirect()->route('home');
        }
        // retrieve messages from messages table
        $messages = Message::where('conversation_id', $id)->orderBy('created_at', 'desc')->get();
        foreach($messages as $message){
            $message->user = User::find($message->sender_id);
        }
        return view('messages', compact('messages'));
    }
    
    // make a new conversation containing participants json
    public function create(Request $request){
        $conversation = new Conversation();
        // todo: parse request data to json
        $conversation->participants = json_encode($request->participants);
        $conversation->save();
        return redirect()->back();
    }

        

}
