<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $inputFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $inputFields['title'] = strip_tags($inputFields['title']);
        $inputFields['body'] = strip_tags($inputFields['body']);
        $inputFields['user_id'] = auth()->id();

        Post::create($inputFields);
        return redirect('/');

    }


    public function showEditScreen(Post $post){
        if(auth()->id() !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request){
        if(auth()->id() !== $post['user_id']){
            return redirect('/');
        }
        $inputFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $inputFields['title'] = strip_tags($inputFields['title']);
        $inputFields['body'] = strip_tags($inputFields['body']);

        $post->update($inputFields);
        return redirect('/');
    }

    public function deletePost(Post $post){
        if(auth()->id() === $post['user_id']){
        $post->delete();
        }

        return redirect('/');
    }


}
