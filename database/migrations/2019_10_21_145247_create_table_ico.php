<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',200);
            $table->string('image_url',500);
            $table->string('category',100);
            $table->longText('description')->nullable();
            $table->longText('short_description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('website',200);
            $table->string('whitepaper',200);
            $table->string('twitter',200);
            $table->string('youtube',200);
            $table->string('facebook',200);
            $table->string('linkedin',200);
            $table->string('github',200);
            $table->string('telegram',200);
            $table->string('reddit',200);
            $table->integer('linkedin_follow')->nullable();
            $table->integer('youtube_follow')->nullable();
            $table->integer('telegram_follow')->nullable();
            $table->integer('reddit_follow')->nullable();
            $table->integer('twitter_follow')->nullable();
            $table->float('rating');
            $table->longText('meta_title');
            $table->longText('meta_desc');
            $table->longText('meta_keyword');

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
        Schema::dropIfExists('ico');
    }
}
