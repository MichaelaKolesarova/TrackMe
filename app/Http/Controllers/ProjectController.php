<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showProjectDashboard(Project $project)
    {
        return view('project_dashboard', ['project' => $project]);

    }
    public function updateChosenTeamCards(Request $request)
    {
        $teamId = $request['teamId'];
        return view('project_dashboard_specific_team_content', ['chosenTeam' => $teamId ])->render();

    }

    public function updateButtonProject(Request $request)
    {
        $teamId = $request['teamId'];
        return view('project_dropdown_button', ['chosenTeam' => $teamId ])->render();

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
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
