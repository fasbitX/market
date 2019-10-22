<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateScoreCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumn(['score_1d', 'score_7d', 'score_14d', 'score_30d', 'score_90d']);
            $table->decimal('score', 24, 8)->default(0)->after('volume_90d');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumn('score');
            $table->decimal('score_1d', 24, 8)->after('volume_90d');
            $table->decimal('score_7d', 24, 8)->after('score_1d');
            $table->decimal('score_14d', 24, 8)->after('score_7d');
            $table->decimal('score_30d', 24, 8)->after('score_14d');
            $table->decimal('score_90d', 24, 8)->after('score_30d');
        });
    }
}
