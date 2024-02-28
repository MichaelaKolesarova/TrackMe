<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['entity_id','who', 'changedWhat', 'toWhat', 'entity_type'];
    public function getWhoName()
    {
        $user = User::find($this->who);
        return $user ? $user->name : 'Unknown User';
    }
}
