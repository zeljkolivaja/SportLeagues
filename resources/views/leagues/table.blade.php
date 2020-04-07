<div class="row d-flex justify-content-center">
    <div class="col-sm-10 col-xl-12">
        <br />
        <h4>Table</h4>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 7%">Name</th>
                    <th scope="col" class="d-none d-sm-table-cell" style="width: 4%">GP</th>
                    <th style="width: 4%">Wins</th>
                    <th style="width: 4%">Losses</th>
                    <th style="width: 4%">Draws</th>
                    <th scope="col" class="d-none d-sm-table-cell" style="width: 4%">Goals S</th>
                    <th scope="col" class="d-none d-sm-table-cell" style="width: 4%">Goals R</th>
                    <th style="width: 4%">Points</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($sorted as $team)
                <tr>
                    <td>
                        {{$team->teamName}}
                    </td>
                    <td scope="col" class="d-none d-sm-table-cell">
                        {{$team->totalGamesPlayed}}
                    </td>
                    <td>
                        {{$team->totalWins}}
                    </td>
                    <td>
                        {{$team->totalLosses}}
                    </td>
                    <td>
                        {{$team->totalDraws}}
                    </td>
                    <td scope="col" class="d-none d-sm-table-cell">
                        {{$team->totalGoalsScored}}
                    </td>
                    <td scope="col" class="d-none d-sm-table-cell">
                        {{$team->totalGoalsConceded}}
                    </td>
                    <td>
                        {{$team->totalPoints}}
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
