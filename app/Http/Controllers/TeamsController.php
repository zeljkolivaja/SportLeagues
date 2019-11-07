<?php

namespace App\Http\Controllers;

use App\Team;
use App\League;

use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team, League $league)
    {
        $team = $league->teams;
        return view('teams.index', compact($team));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(League $league, Request $request)
    {
        $league_id = request('league_id');
        return view('teams.create', compact('league_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(League $league)
    {
        $team = request()->validate(['teamName' => 'min:3|unique:teams']);

        $league->addTeam($team);


        session()->flash('message', 'Your Team has been created');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, League $league)
    {
        $this->authorize('update', $league);

        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team->update($this->validateTeam());
        $id = $team->league_id;
        session()->flash('message', 'Your Team has been updated');
        return redirect('/leagues' . '/' . $id);



        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        session()->flash('message', 'Your Team has been deleted');

        return back();
    }

    public function validateTeam()
    {
        return request()->validate([
             'teamName' => ['required', 'min:3'],
          ]);
    }
}
