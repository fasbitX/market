<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->string('symbol')->primary();
            $table->string('name',100);
            $table->string('code',10);
            $table->string('code_native',10);
            $table->decimal('rate',10,5)->nullable();
            $table->dateTime('last_updated')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency');
    }
}
