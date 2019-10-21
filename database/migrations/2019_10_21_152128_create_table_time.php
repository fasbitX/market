<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ico_id')->unsigned();
            $table->string('name',200);
            $table->string('image',200);
            $table->string('designation',200);
            $table->string('twitter',200);
            $table->string('facebook',200);
            $table->string('linkedin',200);
            $table->string('telegram',200);
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('time', function($table) {
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
        Schema::dropIfExists('time');
    }
}
