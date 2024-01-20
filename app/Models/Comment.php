<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = ['task_id', 'user_id', 'content'];

    public function authoredBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
