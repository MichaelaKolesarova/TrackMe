<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('personal_dashboard');
    }

    public function admin_page()
    {
        return view('admin-page');
    }


    public function team($teamId)
    {
        $team = Team::find($teamId);

        if (!$team) {
            abort(404);
        }

        return view('team_dashboard', ['team' => $team]);
    }

    public function profile()
    {
        return view('profile');
    }
}
