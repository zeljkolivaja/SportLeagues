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
        $owner= $team->select('owner_id')->join('leagues', 'leagues.id', '=', 'teams.league_id')->where('leagues.id', 5)->first();
        return $owner->owner_id == $user->id;
    }
}
