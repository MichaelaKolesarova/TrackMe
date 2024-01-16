<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructures\TaskStatusEnum;
use App\Models\Post;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function createTask(Request $request)
    {
        $inputFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'assignee' => 'required',
            'dueDate' => 'required',
            'priority' => 'required'
        ]);
        $inputFields['title'] = strip_tags($inputFields['title']);
        $inputFields['description'] = strip_tags($inputFields['description']);
        $inputFields['taskStatus'] = TaskStatusEnum::ToDo;
        $inputFields['author'] = auth()->id();

        Task::create($inputFields);
        return redirect('/home');

    }
}
