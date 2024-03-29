<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageBroadcast;
use App\Events\TeamMessageBroadcast;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function openChat($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            abort(404);
        }

        return view('chat/chat', ['user' => $user]);
    }

    public function openTeamChat()
    {
        return view('chat/team_chat');
    }

    public function createMessage(Request $request)
    {
        $inputFields = $request->validate([
            'to' => 'required',
            'content' => 'required',
        ]);
        $inputFields['content'] = strip_tags($inputFields['content']);
        $inputFields['from'] = auth()->id();

        $message = Message::create($inputFields);
        if ( $message->to == 0 ) {
            broadcast(new TeamMessageBroadcast($message->id))->toOthers();
        } else {
            broadcast(new PrivateMessageBroadcast($message->id, $message->from, $message->to));
        }
        return view('chat/broadcast', ['message' => $message])->with('success', 'Message created successfully.');
    }

    public function deleteMessage($id)
    {
        try {
            $message = Message::findOrFail($id);
            if ($message->from == auth()->id()) {
                $message->delete();
                return redirect()->back()->with('success', 'Message deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'You are not authorized to delete this message.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the message.');
        }
    }

    public function editMessage(Request $request)
    {
        $id = $request['id'];
        try {
            $message = Message::findOrFail($id);
            if (auth()->id() !== $message->from) {
                return redirect()->back()->with('error', 'You are not authorized to edit this message');
            }

            $request->validate([
                'content' => 'required|string',
            ]);

            $message->content = $request->input('content');
            $message->save();

            return redirect()->back()->with('success', 'Message updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Not fount the message');
        }
    }


    public function receive(Request $request)
    {
        return view('chat/receive', ['id' => $request->get('id')]);
    }
}
