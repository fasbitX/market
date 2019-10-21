<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('symbol',20)->nullable(false);
            $table->string('name',75)->nullable(false);
            $table->string('logo',200)->nullable(false);
            $table->decimal('price',20,10);
            $table->decimal('change',16,6);
            $table->decimal('change_pct',10,2);
            $table->decimal('open',20,10);
            $table->decimal('low',20,10);
            $table->decimal('high',20,10);
            $table->float('supply',30,2);
            $table->float('market_cap',30,2);
            $table->float('volume',30,2);
            $table->float('volume_ccy',30,2);
            $table->dateTime('last_updated');
            $table->tinyInteger('active')->nullable(false)->default(1);
            $table->string('proof_type',50);
            $table->string('website',200);
            $table->string('twitter',100);
            $table->longText('description');
            $table->longText('features');
            $table->longText('technology');
            $table->float('total_supply',30,2);
            $table->longText('intraday_quotes');
            $table->longText('subs');
            $table->tinyInteger('featured')->nullable(false)->default(0);
        });
    }

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('coin');
}
}
