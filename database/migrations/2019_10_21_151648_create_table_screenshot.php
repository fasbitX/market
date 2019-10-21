<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScreenshot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenshot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ico_id')->unsigned();
            $table->string('name',200);
            $table->string('image',500);
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('screenshot', function($table) {
            $table->foreign('ico_id')->references('id')->on('ico')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screenshot');
    }
}
