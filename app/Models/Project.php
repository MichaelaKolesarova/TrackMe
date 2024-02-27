<?php

namespace App\Models;

use App\Helpers\DataStructures\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['project_lead', 'project_name'];
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'tasks', 'project', 'team_assigned_to')->distinct();
    }

}
