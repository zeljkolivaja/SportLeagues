<?php

namespace App\Http\Controllers;

use App\League;
use App\Team;
use Illuminate\Http\Request;

class LeaguesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $leagues = auth()->user()->leagues;

        // dd($leagues);

        return view('leagues.index', compact('leagues'));
    }

    public function reset(Team $teams,Request $request)
    {
        $league = $request->input('league');

        $teams->reset($league);
        return back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leagues.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $league = $this->validateLeague();
        $league['owner_id'] = auth()->id();
        $league = League::create($league);
        session()->flash('message', 'Your League has been created');
        return redirect('/leagues');
    }

    public function validateLeague()
    {
        return request()->validate([
            'leagueName' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function show(League $league)
    {
        // if ($league->owner_id != auth()->id()){
        //     abort(403);
        // }

        $this->authorize('update', $league);

        $array = json_decode($league->teams, true);
        $members = array_column($array, 'teamName');

        function scheduler($members)
        {
            if (count($members)%2 != 0) {
                array_push($members, "slobodan");
            }
            $away = array_splice($members, (count($members)/2));
            $home = $members;
            for ($i=0; $i < count($home)+count($away)-1; $i++) {
                for ($j=0; $j<count($home); $j++) {
                    $round[$i][$j]["Home"]=$home[$j];
                    $round[$i][$j]["Away"]=$away[$j];
                }
                if (count($home)+count($away)-1 > 2) {
                    // array_unshift($away,array_shift(array_splice($home,1,1)));
                    array_unshift($away, current(array_splice($home, 1, 1)));
                    array_push($home, array_pop($away));
                }
            }
            if (isset($round)) {
                return $round;
            }
        }
        $schedule = scheduler($members);

        $team = $league->teams;
        // $sorted = $team
        // ->sortByDesc('totalGoalsScored - totalGoalsConceded')
        // ->sortByDesc('totalPoints');

        $sorted = $league->teams()
              ->orderBy('totalPoints', 'DESC')
              ->selectRaw('*, totalGoalsScored - totalGoalsConceded as total')
              ->orderBy('total', 'DESC')
              ->orderBy('totalGoalsScored', 'DESC')
              ->get();


        return view('leagues.show', compact('sorted', 'league', 'schedule'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        $this->authorize('update', $league);

        return view('leagues.edit', compact('league'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        $this->authorize('update', $league);

        $league->update($this->validateLeague());
        session()->flash('message', 'Your League has been updated');

        return redirect('/leagues');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        $this->authorize('update', $league);

        $league->delete();
        session()->flash('message', 'Your League has been deleted');

        return redirect('/home');
    }
}
