<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_coin')->unsigned();
            $table->integer('rank');
            $table->string('symbol',255);
            $table->decimal('price',24,5);
            $table->decimal('f_price',24,2)->nullable();
            $table->decimal('percent_change_24h',24,6)->nullable();
            $table->decimal('volume_24h',24,5);
            $table->decimal('f_volume_24h',24,2)->nullable();
            $table->decimal('market_cap',24,2);
            $table->string('f_market_cap',255);
            $table->string('image_url',255);
            $table->string('btc_price',255);
            $table->integer('status');
            $table->string('website',255);
            $table->string('algorithm',255);
            $table->string('prooftype',255);
            $table->string('total_supply',255);
            $table->longText('description');
            $table->longText('features');
            $table->longText('technology');
            $table->timestamps();
            $table->decimal('percent_change7d',24,2)->nullable();
            $table->decimal('volume_30d',24,2)->nullable();
            $table->decimal('volume_14d',24,2)->nullable();
            $table->decimal('volume_90d',24,2)->nullable();
            $table->double('percent_change7d',8,6)->nullable();
            $table->double('percent_change30d',8,6)->nullable();
            $table->double('percent_change14d',8,6)->nullable();
            $table->double('percent_change90d',8,6)->nullable();
            $table->decimal('score_1d',24,5)->nullable();
            $table->decimal('score_7d',24,5);->nullable();
            $table->decimal('score_14d',24,5)->nullable();
            $table->decimal('score_30d',24,5)->nullable();
            $table->decimal('score_90d',24,5)->nullable();
        });

        Schema::table('coins', function($table) {
            $table->foreign('id_coin')->references('id')->on('coin')->onDelete('cascade');
        });
    }

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('coins');
}
}
