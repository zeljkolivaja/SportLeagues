<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable = [
        'leagueName', 'description', 'owner_id'
    ];


    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    public function teams()
    {
        return $this->hasMany(Team::class);
    }


    public function addTeam($team)
    {
        $this->teams()->create($team);
        //    return Team::create([
    //         'teamName' => $teamName,
    //         'league_id' => $this->id
    //     ]);
    }
}
