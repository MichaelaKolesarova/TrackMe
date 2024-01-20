<?php

namespace App\Http\Controllers;

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

        return view('chat', ['user' => $user]);
    }

    public function openTeamChat()
    {
        return view('team_chat');
    }

    public function createMessage(Request $request)
    {

        $inputFields = $request->validate([
            'to' => 'required',
            'content' => 'required',
        ]);
        $inputFields['content'] = strip_tags($inputFields['content']);
        $inputFields['from'] = auth()->id();

        Message::create($inputFields);
        return redirect()->back()->with('success', 'Message created successfully');
    }
}
