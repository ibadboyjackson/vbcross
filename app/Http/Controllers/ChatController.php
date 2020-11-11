<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
//    public function inbox($selectedConversationId = null)
//    {
//        $userId = Auth::id();
//        $conversations = Conversation::with('chat')
//                        ->where('member_one' , $userId)
//                        ->orWhere('member_two' , $userId)
//                        ->get();
//
//        return view('chat.inbox' , compact('conversations' ,'selectedConversationId'));
//    }

    public function startConversation(User $receiver)
    {
        $sender = Auth::user();
        if (Conversation::where('member_one', $sender->id)->where('member_two', $receiver->id)->exists()) {
            $conversation = Conversation::where('member_one', $sender->id)->orWhere('member_two', $receiver->id)->get()->first();
            return redirect()->route('chat', $conversation->id);
        }

        if (Conversation::where('member_two', $sender->id)->where('member_one', $receiver->id)->exists()) {
            $conversation = Conversation::where('member_two', $sender->id)->orWhere('member_one', $receiver->id)->get()->first();
            return redirect()->route('chat', $conversation->id);
        }

        $conversation = Conversation::create([
            'member_one' => $receiver->id,
            'member_two' => $sender->id,
        ]);

        return redirect()->route('chat', $conversation->id);
    }

    public function startChallenge(User $receiver)
    {
        $sender = Auth::user();
        $challengeMessage = 'Member ' . $sender->name . ' has challenged you to a duel.';
        if (Conversation::where('member_one', $sender->id)->where('member_two', $receiver->id)->exists()) {
            $conversation = Conversation::where('member_one', $sender->id)->orWhere('member_two', $receiver->id)->get()->first();
            $this->sendMessage($conversation->id, $sender->id, $receiver->id, $challengeMessage);
            return redirect()->route('chat', $conversation->id);
        }

        if (Conversation::where('member_two', $sender->id)->where('member_one', $receiver->id)->exists()) {
            $conversation = Conversation::where('member_two', $sender->id)->orWhere('member_one', $receiver->id)->get()->first();
            $this->sendMessage($conversation->id, $sender->id, $receiver->id, $challengeMessage);
            return redirect()->route('chat', $conversation->id);
        }

        $conversation = Conversation::create([
            'member_one' => $receiver->id,
            'member_two' => $sender->id,
        ]);

        $this->sendMessage($conversation->id, $sender->id, $receiver->id, $challengeMessage);

        return redirect()->route('chat', $conversation->id);
    }

    public function sendMessage($conversationId, $senderId, $receiverId, $message)
    {
        \App\Chat::create([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message,
        ]);
    }

    public function globalMessage()
    {
        return view('chat.global-message');
    }

    public function sendGlobalMessage(Request $request)
    {
        $request->validate([
            'message' => ['required']
        ]);

        $message = $request->message;
        $users = User::role('user')->get();
        $adminId = Auth::id();
        foreach ($users as $user) {
            $receiverId = $user->id;
            $conversation = Conversation::updateOrCreate([
                'member_one' => $receiverId,
                'member_two' => $adminId, // admin is sender and member two is always admin for now
            ],
                [
                    'member_one' => $receiverId,
                    'member_two' => $adminId, // admin is sender and member two is always admin for now
                ]);

            $this->sendMessage($conversation->id, $adminId, $receiverId, $message);
        }

        return redirect()->route('chat');

    }


}
