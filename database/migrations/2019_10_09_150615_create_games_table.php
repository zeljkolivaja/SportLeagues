<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('homeTeam');
            $table->unsignedBigInteger('awayTeam');
            $table->unsignedBigInteger('league');
            $table->integer('homeTeamGoals');
            $table->integer('awayTeamGoals');
            $table->string('awayTeamName');
            $table->string('homeTeamName');



            $table->foreign('homeTeam')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('awayTeam')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('league')->references('id')->on('leagues')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
