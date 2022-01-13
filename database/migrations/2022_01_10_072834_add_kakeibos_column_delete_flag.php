<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKakeibosColumnDeleteFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kakeibos', function (Blueprint $table) {
            //kakeibosテーブルに削除済みか否かを表すdelete_flagカラムを作成
            $table->boolean('delete_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kakeibos', function (Blueprint $table) {
            $table->dropColumn('delete_flag');
        });
    }
}
