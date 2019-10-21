<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLiveData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_data', function (Blueprint $table) {
            $table->increments('my_id');
            $table->integer('id');
            $table->string('name',50)->nullable();
            $table->string('price',20)->nullable();
            $table->string('percent_change_24h',10)->nullable();
            $table->string('volume_24h',50)->nullable();
            $table->string('image_url',50)->nullable();
            $table->string('chart_image',100)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_data');
    }
}
