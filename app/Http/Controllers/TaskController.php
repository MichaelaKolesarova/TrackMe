<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructures\EntitiesEnum;
use App\Helpers\DataStructures\ProjectActivitiesEnum;
use App\Helpers\DataStructures\TaskActivitiesEnum;
use App\Helpers\DataStructures\TaskStatusEnum;
use App\Models\Post;
use App\Models\Task;
use App\Models\Log;
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
            'priority' => 'required',
            'project' => 'required',
            'parent_task' => 'nullable|integer',
        ]);
        if( $inputFields['assignee'] == 0){
            $inputFields['assignee'] = null;
        }
        if (isset($inputFields['parent_task']) && $inputFields['parent_task'] == 0) {
            $inputFields['parent_task'] = null;
        }
        $inputFields['title'] = strip_tags($inputFields['title']); //html tags
        $inputFields['description'] = strip_tags($inputFields['description']);
        $inputFields['author'] = auth()->id();
        $task = Task::create($inputFields);
        Log::create([
            'entity_id' => $task->id,
            'who' => auth()->id(),
            'changedWhat' => TaskActivitiesEnum::Create,
            'entity_type' => EntitiesEnum::Task,
        ]);
        if($task->parent_task == null){
            Log::create([
                'entity_id' => $task->project,
                'who' => auth()->id(),
                'changedWhat' => ProjectActivitiesEnum::CreatedNewRootTask,
                'toWhat' => $task->id,
                'entity_type' => EntitiesEnum::Project,
            ]);
        } else {
            Log::create([
                'entity_id' => $task->parent_task,
                'who' => auth()->id(),
                'changedWhat' => TaskActivitiesEnum::CreateChildTask,
                'toWhat' => $task->id,
                'entity_type' => EntitiesEnum::Task,
            ]);
            Log::create([
                'entity_id' => $task->project,
                'who' => auth()->id(),
                'changedWhat' => ProjectActivitiesEnum::CreatedNewSubtask,
                'toWhat' => $task->id,
                'entity_type' => EntitiesEnum::Project,
            ]);
        }

        return redirect()->back()->with(['message' => 'Task created successfully']);

    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found.');
        }
        $task->delete();
        return redirect()->route('home')->with('success', 'Task deleted successfully.');
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
        Log::create([
            'entity_id' => $task->id,
            'who' => auth()->id(),
            'changedWhat' => TaskActivitiesEnum::UpdateTaskStatus,
            'toWhat' => $request->get('taskStatus'),
            'entity_type' => EntitiesEnum::Task,
        ]);

        return redirect()->back()->with(['message' => 'Task updated successfully']);
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
        Log::create([
            'entity_id' => $task->id,
            'who' => auth()->id(),
            'changedWhat' => TaskActivitiesEnum::UpdateTaskStatus,
            'toWhat' => $request->get('newStatus'),
            'entity_type' => EntitiesEnum::Task,
        ]);

        return redirect()->back()->with(['success' => 'Task updated successfully']);

    }

    public function updateTaskPriority(Request $request)
    {

        $inputFields = $request->validate([
            'taskId' => 'required',
            'newStatus' => 'required'
        ]);

        $task = Task::find($inputFields['taskId']);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->priority = $inputFields['newStatus'];
        $task->save();
        Log::create([
            'entity_id' => $task->id,
            'who' => auth()->id(),
            'changedWhat' => TaskActivitiesEnum::UpdatePriority,
            'toWhat' => $request->get('newStatus'),
            'entity_type' => EntitiesEnum::Task,
        ]);

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
        Log::create([
            'entity_id' => $task->id,
            'who' => auth()->id(),
            'changedWhat' => TaskActivitiesEnum::UpdateAssignee,
            'toWhat' => $request->get('newAssignee'),
            'entity_type' => EntitiesEnum::Task,
        ]);

        return redirect()->back()->with(['success' => 'Task updated successfully']);

    }

    public function showTaskOverview(Task $task)
    {
        return view('task_overview', ['task' => $task]);

    }

    public function updateChosenUserCards(Request $request)
    {
        $userId = $request['userId'];
        $teamId = $request['teamId'];
        return view('team_dashboard_specific_member_content',['chosenUser' => $userId, 'chosenTeam'  => $teamId])->render();

    }

    public function updateButton(Request $request)
    {
        $userId = $request['userId'];
        $teamId = $request['teamId'];
        return view('dropdown_button',['chosenUser' => $userId, 'chosenTeam'  => $teamId])->render();

    }
}
