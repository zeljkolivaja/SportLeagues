<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded=[];

    public function owner()
    {
        return $this->belongsTo(Team::class);
    }

    public function newMatch($game)
    {
        $this->create($game);
    }
}
