<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'author', 'assignee', 'dueDate', 'priority', 'taskStatus'];

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



}
