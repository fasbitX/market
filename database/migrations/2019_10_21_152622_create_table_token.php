<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ico_id')->unsigned();
            $table->string('white_list',50);
            $table->string('pre_sale',50);
            $table->string('ticker',30);
            $table->string('platform',30);
            $table->string('country',30);
            $table->string('accepting',30);
            $table->integer('soft_cap');
            $table->integer('hard_cap');
            $table->integer('total_token');
            $table->string('available_sale',30);
            $table->string('bounty',30);
            $table->string('kyc',30);
            $table->string('images',30)->nullable();
            $table->timestamps();
        });

        Schema::table('token', function($table) {
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
        Schema::dropIfExists('token');
    }
}
