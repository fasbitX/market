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
            $table->decimal('score_1d',24,5);
            $table->decimal('score_7d',24,5);
            $table->decimal('score_14d',24,5);
            $table->decimal('score_30d',24,5);
            $table->decimal('score_90d',24,5);
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
