<?php

namespace App\Policies;

use App\League;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaguePolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can update the league.
     *
     * @param  \App\User  $user
     * @param  \App\League  $league
     * @return mixed
     */
    public function update(User $user, League $leagues)
    {
        return $leagues->owner_id == $user->id;
        // return dd($leagues->first()->owner_id);
        // return $user->id == $leagues->first()->owner_id;
    }

 }
