<?php

namespace App\Http\Controllers;

use App\Game;
use App\Team;

use DB;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Game $game,Request $request)
    {
        $league = $request->input('league');
        $games = $game->showGames($league);
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game

     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $team, Game $games)
    {
        $game = $this->validateGameResult();
        $game = $request->all();

        //creates separate variables from $game array
        extract($game);

        $homeTeamName = $homeTeam;
        $awayTeamName = $awayTeam;

        $homeTeam = $team->select('id')->where('teamName', $homeTeam)->get();
        $homeTeam = $homeTeam[0]["id"];

        $awayTeam = $team->select('id')->where('teamName', $awayTeam)->get();
        $awayTeam = $awayTeam[0]["id"];



        // checks if the game already exists, if it does it redirects and ask delete/abort


        if ($games->where('homeTeam', $homeTeam)->where('awayTeam', $awayTeam)->first()) {
            $match = $games->where('homeTeam', $homeTeam)->where('awayTeam', $awayTeam)->get();
            $match[0]["home"] = $homeTeamName;
            $match[0]["away"] = $awayTeamName;

            // json_encode($match);

            return "2";
            return view('games.show', compact('match'));
        }

        $game['homeTeamName'] = $homeTeamName;
        $game['awayTeamName'] = $awayTeamName;
        $game['homeTeam'] = $homeTeam;
        $game['awayTeam'] = $awayTeam;


        //creates new game in games table
        $games->newMatch($game);


        //update teams stats in teams table (totalPoints, totalGoalsScored etc)
        if ($homeTeamGoals > $awayTeamGoals) {
            $team->updateTableHomeWin($game);
        } elseif ($awayTeamGoals > $homeTeamGoals) {
            $team->updateTableAwayWin($game);
        }
        if ($awayTeamGoals == $homeTeamGoals) {
            $team->updateTableDraw($game);
        }
        // session()->flash('message', 'Your Result was added');

        return back();
    }

    public function validateGameResult()
    {
        return request()->validate([
            'homeTeamGoals' => ['required', 'Numeric'],
            'awayTeamGoals' => ['required', 'Numeric']
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, Request $request, Team $team)
    {
        if ($game->homeTeamGoals > $game->awayTeamGoals) {
            $team->deleteUpdateTableHomeWin($game);
        }

        if ($game->homeTeamGoals < $game->awayTeamGoals) {
            $team->deleteUpdateTableAwayWin($game);
        }

        if ($game->homeTeamGoals == $game->awayTeamGoals) {
            $team->deleteUpdateTableDraw($game);
        }

        $game->delete();

        session()->flash('message', 'Your Game has been deleted');



        return back();
    }
}
