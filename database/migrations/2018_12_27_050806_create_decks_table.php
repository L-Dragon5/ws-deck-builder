<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_decks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->unsigned();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('win_location', 255)->nullable();
            $table->date('win_date')->nullable();
            $table->tinyInteger('win_participants')->nullable();
            $table->string('win_result')->nullable();
            $table->tinyInteger('win_ranking')->nullable();
            $table->json('deck');
            $table->text('hash');
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('ws_series')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_decks');
    }
}
