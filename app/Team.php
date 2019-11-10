<?php

namespace App;

use DB;
use App\Game;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded=[];




    public function leagues()
    {
        return $this->belongsTo(League::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'homeTeam', 'awayTeam');
    }

    public function updateTableHomeWin($game)
    {
        extract($game);
        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'totalPoints' => DB::raw('totalPoints + 3'),
            'totalGoalsScored' => DB::raw('totalGoalsScored +' . (int)$homeTeamGoals),
            'totalGoalsConceded' => DB::raw('totalGoalsConceded +' . (int)$awayTeamGoals),
            'totalGamesPlayed' => DB::raw('totalGamesPlayed + 1'),
            'totalWins' => DB::raw('totalWins + 1')

        ]);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'totalGoalsScored' => DB::raw('totalGoalsScored +' . (int)$awayTeamGoals),
            'totalGoalsConceded' => DB::raw('totalGoalsConceded +' . (int)$homeTeamGoals),
            'totalGamesPlayed' => DB::raw('totalGamesPlayed + 1'),
            'totalLosses' => DB::raw('totalLosses + 1')

        ]);
    }


    public function updateTableAwayWIn($game)
    {
        extract($game);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'totalPoints' => DB::raw('totalPoints + 3'),
            'totalGoalsScored' => DB::raw('totalGoalsScored +' . (int)$awayTeamGoals),
            'totalGoalsConceded' => DB::raw('totalGoalsConceded +' . (int)$homeTeamGoals),
            'totalGamesPlayed' => DB::raw('totalGamesPlayed + 1'),
            'totalWins' => DB::raw('totalWins + 1')

        ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
                'totalGoalsScored' => DB::raw('totalGoalsScored +' . (int)$homeTeamGoals),
                'totalGoalsConceded' => DB::raw('totalGoalsConceded +' . (int)$awayTeamGoals),
                'totalGamesPlayed' => DB::raw('totalGamesPlayed + 1'),
                'totalLosses' => DB::raw('totalLosses + 1')

            ]);
    }

    public function updateTableDraw($game)
    {
        extract($game);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'totalPoints' => DB::raw('totalPoints + 1'),
            'totalGoalsScored' => DB::raw('totalGoalsScored +' . (int)$awayTeamGoals),
            'totalGoalsConceded' => DB::raw('totalGoalsConceded +' . (int)$homeTeamGoals),
            'totalGamesPlayed' => DB::raw('totalGamesPlayed + 1'),
            'totalDraws' => DB::raw('totalDraws + 1')

        ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
                'totalPoints' => DB::raw('totalPoints + 1'),
                'totalGoalsScored' => DB::raw('totalGoalsScored +' . (int)$homeTeamGoals),
                'totalGoalsConceded' => DB::raw('totalGoalsConceded +' . (int)$awayTeamGoals),
                'totalGamesPlayed' => DB::raw('totalGamesPlayed + 1'),
                'totalDraws' => DB::raw('totalDraws + 1')

            ]);
    }

    public function deleteUpdateTableHomeWin($game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;
        $league = $game->league;
        $homeTeamGoals =  $game->homeTeamGoals;
        $awayTeamGoals = $game->awayTeamGoals;

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'totalPoints' => DB::raw('totalPoints - 3'),
            'totalGoalsScored' => DB::raw('totalGoalsScored -' . (int)$homeTeamGoals),
            'totalGoalsConceded' => DB::raw('totalGoalsConceded -' . (int)$awayTeamGoals),
            'totalGamesPlayed' => DB::raw('totalGamesPlayed - 1'),
            'totalWins' => DB::raw('totalWins - 1')

        ]);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'totalGoalsScored' => DB::raw('totalGoalsScored -' . (int)$awayTeamGoals),
            'totalGoalsConceded' => DB::raw('totalGoalsConceded -' . (int)$homeTeamGoals),
            'totalGamesPlayed' => DB::raw('totalGamesPlayed - 1'),
            'totalLosses' => DB::raw('totalLosses - 1')

        ]);
    }

    public function deleteUpdateTableAwayWin($game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;
        $league = $game->league;
        $homeTeamGoals =  $game->homeTeamGoals;
        $awayTeamGoals = $game->awayTeamGoals;

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
                'totalPoints' => DB::raw('totalPoints - 3'),
                'totalGoalsScored' => DB::raw('totalGoalsScored -' . (int)$awayTeamGoals),
                'totalGoalsConceded' => DB::raw('totalGoalsConceded -' . (int)$homeTeamGoals),
                'totalGamesPlayed' => DB::raw('totalGamesPlayed - 1'),
                'totalWins' => DB::raw('totalWins - 1')

            ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
                'totalGoalsScored' => DB::raw('totalGoalsScored -' . (int)$homeTeamGoals),
                'totalGoalsConceded' => DB::raw('totalGoalsConceded -' . (int)$awayTeamGoals),
                'totalGamesPlayed' => DB::raw('totalGamesPlayed - 1'),
                'totalLosses' => DB::raw('totalLosses - 1')




            ]);
    }


    public function reset($league)
    {
         $this->where('league_id', $league)->update(['totalPoints' =>  0, 'totalGoalsScored'=> 0, 'totalGoalsConceded' => 0, 'totalGamesPlayed' => 0,
         'totalWins' => 0, 'totalLosses'=> 0, 'totalDraws' => 0]);
         $games = new Game;
         $games->where('league', $league)->delete();

    }




    public function deleteUpdateTableDraw($game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;
        $league = $game->league;
        $homeTeamGoals =  $game->homeTeamGoals;
        $awayTeamGoals = $game->awayTeamGoals;

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
                    'totalPoints' => DB::raw('totalPoints - 1'),
                    'totalGoalsScored' => DB::raw('totalGoalsScored -' . (int)$awayTeamGoals),
                    'totalGoalsConceded' => DB::raw('totalGoalsConceded -' . (int)$homeTeamGoals),
                    'totalGamesPlayed' => DB::raw('totalGamesPlayed - 1'),
                    'totalDraws' => DB::raw('totalDraws - 1')

                ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
                    'totalPoints' => DB::raw('totalPoints - 1'),
                    'totalGoalsScored' => DB::raw('totalGoalsScored -' . (int)$homeTeamGoals),
                    'totalGoalsConceded' => DB::raw('totalGoalsConceded -' . (int)$awayTeamGoals),
                    'totalGamesPlayed' => DB::raw('totalGamesPlayed - 1'),
                    'totalDraws' => DB::raw('totalDraws - 1')



                ]);
    }
}
