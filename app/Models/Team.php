<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['team_lead', 'team_name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_membership', 'team', 'user');
    }

    public function usersNotInTeam()
    {
        return User::whereNotIn('users.id', $this->users()->pluck('users.id'));
    }






}
