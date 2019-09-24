<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('symbol');
            $table->decimal('price',24,5);
            $table->float('percent_change_1d');
            $table->double('percent_change_7d',8,2);
            $table->double('percent_change_30d',8,2);
            $table->decimal('volume_24h',24,5);
            $table->decimal('volume_7d',24,5);
            $table->decimal('volume_30d',24,5);
            $table->date("Date");
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
        Schema::dropIfExists('coins_history');
    }
}
