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
            $table->integer('totalPoints')->default('0');
            $table->integer('totalGoalsScored')->default('0');
            $table->integer('totalGoalsConceded')->default('0');
            $table->integer('totalGamesPlayed')->default('0');
            $table->integer('totalWins')->default('0');
            $table->integer('totalLosses')->default('0');
            $table->integer('totalDraws')->default('0');
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
