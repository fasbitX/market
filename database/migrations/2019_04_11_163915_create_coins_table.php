<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsTable extends Migration
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
            $table->string('symbol');
            $table->string('name');
            $table->decimal('price',24,5);
            $table->string('f_price');
            $table->float('percent_change_24h');
           // $table->string('f_percent_change_24h');
            $table->decimal('volume_24h',24,5);
            $table->string('f_volume_24h');
            $table->decimal('market_cap',24,2);
            $table->string('f_market_cap');
            $table->string('image_url');
            $table->string('chart_image');
            $table->string('btc_price');
            $table->integer('status');
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
        Schema::dropIfExists('coins');
    }
}
