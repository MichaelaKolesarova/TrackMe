<?php

namespace App\Http\Controllers;

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
}
