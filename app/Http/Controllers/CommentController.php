<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $inputFields = $request->validate([
            'content' => 'required',
            'task_id' => 'required',
        ]);
        $inputFields['content'] = strip_tags($inputFields['content']);
        $inputFields['user_id'] = auth()->id();

        Comment::create($inputFields);
        return redirect()->back()->with('success', 'Comment created successfully');

    }
}
