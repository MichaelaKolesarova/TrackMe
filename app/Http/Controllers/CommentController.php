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

    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            if ($comment->user_id == auth()->id()) {
                $comment->delete();
                return redirect()->back()->with('success', 'Comment deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the comment.');
        }
    }

    public function editComment(Request $request)
    {
        $id = $request['id'];
        try {
            $comment = Comment::findOrFail($id);
            if (auth()->id() !== $comment->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to edit this comment');
            }

            $request->validate([
                'content' => 'required|string',
            ]);

            $comment->content = $request->input('content');
            $comment->save();

            return redirect()->back()->with('success', 'Comment updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Not fount the comment');
        }
    }
}
