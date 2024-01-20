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
        if( $inputFields['assignee'] == 0){
            $inputFields['assignee'] = null;
        }
        $inputFields['title'] = strip_tags($inputFields['title']);
        $inputFields['description'] = strip_tags($inputFields['description']);
        //$inputFields['taskStatus'] = TaskStatusEnum::ToDo;
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

        redirect()->back()->with(['message' => 'Task updated successfully']);
    }

    public function updateTaskStatus(Request $request)
    {

        $inputFields = $request->validate([
            'taskId' => 'required',
            'newStatus' => 'required'
        ]);

        $task = Task::find($inputFields['taskId']);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->taskStatus = $inputFields['newStatus'];
        $task->save();

        return redirect()->back()->with(['success' => 'Task updated successfully']);

    }

    public function updateAssignee(Request $request)
    {

        $inputFields = $request->validate([
            'taskId' => 'required',
            'newAssignee' => 'required'
        ]);

        $task = Task::find($inputFields['taskId']);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        if( $inputFields['newAssignee'] == 0){
            $task->assignee = null;
        } else{
            $task->assignee = $inputFields['newAssignee'];
        }
        $task->save();

        return redirect()->back()->with(['success' => 'Task updated successfully']);

    }

    public function showTaskOverview(Task $task)
    {
        return view('task_overview', ['task' => $task]);

    }




}
