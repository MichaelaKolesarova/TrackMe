<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    use HasFactory;
    protected $fillable = ['task','who', 'changedWhat', 'toWhat'];
    public function getWhoName()
    {
        $user = User::find($this->who);
        return $user ? $user->name : 'Unknown User';
    }
}
