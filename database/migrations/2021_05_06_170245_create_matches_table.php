<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->date('Date');
            $table->string('HomeTeam');
            $table->string('AwayTeam');
            $table->integer('FTHG');
            $table->integer('FTAG');
            $table->string('FTR');
            $table->integer('HTHG');
            $table->integer('HTAG');
            $table->string('HTR');
            $table->string('Referee');
            $table->integer('HS');
            $table->integer('AS');
            $table->integer('HST');
            $table->integer('AST');
            $table->integer('HF');
            $table->integer('AF');
            $table->integer('HC');
            $table->integer('AC');
            $table->integer('HY');
            $table->integer('AY');
            $table->integer('HR');
            $table->integer('AR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
