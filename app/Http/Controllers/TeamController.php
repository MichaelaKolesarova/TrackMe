<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function removeTeam($teamId)
    {
        $team = Team::findOrFail($teamId);
        $team->delete();
        return redirect()->back()->with('success', 'Team removed successfully');
    }

    public function addNewTeam(Request $request)
    {
        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255',
            'team_lead' => 'required|exists:users,id',
        ]);

        Team::create([
            'team_name' => $validatedData['team_name'],
            'team_lead' => $validatedData['team_lead'],
        ]);

        return redirect()->back()->with('success', 'New team added successfully');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
