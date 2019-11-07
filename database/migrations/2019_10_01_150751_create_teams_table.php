<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('teamName');
            $table->integer('totalPoints');
            $table->integer('totalGoalsScored');
            $table->integer('totalGoalsConceded');
            $table->integer('totalGamesPlayed');
            $table->integer('totalWins');
            $table->integer('totalLosses');
            $table->integer('totalDraws');
            $table->unsignedBigInteger('league_id');


            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
