<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'author', 'assignee', 'dueDate', 'priority', 'taskStatus', 'parent_task', 'project', 'team_assigned_to'];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assignee');
    }

    public function authoredBy()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function unassigned()
    {
        return $this::all()->whereNull('assigned');
    }
    public function parentTask()
    {
        return $this->belongsTo(Task::class, 'parent_task');
    }

    public function childTasks()
    {
        return $this->hasMany(Task::class, 'parent_task');
    }

}
