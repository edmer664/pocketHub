<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MessageController extends Controller
{
    public function index(Request $request){
        // return view
        $user = Auth::user();
        
        return view('messages.latestMessage');
        
    }
    //send message
    public function send(Request $request,$id){
        Log::info("messageController: send");
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
        
        // create new conversation
        $conversation = new Conversation();
        $conversation->sender_id = $request->user()->id;
        $conversation->receiver_id = $request->receiver_id;
        $conversation->save();
        // return conversation id as json
        Log::info("messageController: createCoversation");
        return response()->json(['conversation_id'=>$conversation->id]);
        
        
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
            if($lastMessage){

                $conversation->lastMessage = $lastMessage;
                $conversation->time = $lastMessage->created_at->diffForHumans();
                $conversation->user = $user;
            }
        };
        $conversations = $conversations->toArray();
        // sort conversations by last message

        try{

            usort($conversations, function($a, $b) {
                return $b['lastMessage']['created_at'] <=> $a['lastMessage']['created_at'];
            });
        }catch(Exception $e){
            Log::info($e);
        }
        $conversations = collect($conversations);


        return response()->json($conversations);
    }
   
    


    // get messages in descending order
    public function getMessages(Request $request, $id){
        // get last 20 messages where conversation id is equal to the id

        $messages = Message::where('conversation_id', $id)->orderBy('created_at')->take(20)->get();
        return response()->json($messages);
    }

    // search conversations with first name as input
    public function searchUsers(Request $request,$name){
        // search users where name is like first_name + last_name
        $looked_up_users = User::where('first_name', 'like', '%'.$name.'%')
            ->orWhere('last_name', 'like', '%'.$name.'%')->get();
        // get conversations where looked_up_users and current user is sender or receiver
        Log::info($looked_up_users);
        return response()->json($looked_up_users);
    }

    // check if conversation exist then return conversation
    public function checkConversation(Request $request,$id){
        // check if conversation exists
        $conversation = Conversation::where('sender_id', $request->user()->id)->orWhere('receiver_id', $request->user()->id)
            ->where('sender_id', $id)->orWhere('receiver_id',$id)->first();
        if($conversation){
            Log::info("New Entry Request: ");
            Log::info("Current user: " . $request->user()->id);
            Log::info("Other user: " . $conversation->sender_id);
            Log::info("Current conversation: " . $conversation->id);
            Log::info("Receiver Id " . $conversation->receiver_id);

            if($conversation->sender_id == $request->user()->id || $conversation->receiver_id == $request->user()->id){
                if($conversation->sender_id == $id || $conversation->receiver_id == $id){

                    Log::info("Condition Met line 118");
                    $conversation->is_found = true;
                    return response()->json($conversation);
                }
                else{
                    Log::info("Condition Not Met line 123");
                    $conversation->is_found = false;
                    return response()->json($conversation);
                }
            }else{
                Log::info("Condition not met line 128");
                $conversation->is_found = false;
                return response()->json($conversation);
            }
        }else{
            Log::info("Conversation not found line 133");
            
            return response()->json(['is_found'=>false]);
            
        }
    }
    



}


        

