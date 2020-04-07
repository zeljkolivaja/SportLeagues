<?php

namespace App\Policies;

use App\Team;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function update(User $user, Team $team)
    {
        $leagueId= $team->league_id;
        $league = new \App\League;
        $owner_id = $league->where('id', $leagueId)->first()->owner->id;
 
         return $owner_id == $user->id;
    }
}
