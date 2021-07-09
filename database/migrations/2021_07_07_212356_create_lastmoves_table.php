<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLastmovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lastmoves', function (Blueprint $table) {
            $table->id();
            $table->char('char',1);
            $table->unsignedBigInteger('position');
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                  ->references('id')
                  ->on('games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lastmoves');
    }
}
