<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFavCoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fav_coin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coin_id')->unsigned();
            $table->integer('user_id')->unsigned();


            $table->timestamps();
        });

        Schema::table('fav_coin', function($table) {
            $table->foreign('coin_id')->references('id')->on('coin')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fav_coin');
    }
}
