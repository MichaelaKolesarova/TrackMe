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

    public function updateTask(Request $request, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $this->validate($request, [
            'taskStatus' => 'required']);

        $task->taskStatus = $request->get('taskStatus');
        $task->save();

        return response()->json(['message' => 'Task updated successfully']);
    }

    public function showTaskOverview(Task $task)
    {
        return view('task_overview', ['task' => $task]);

    }




}
