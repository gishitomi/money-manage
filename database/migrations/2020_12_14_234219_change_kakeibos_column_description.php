<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKakeibosColumnDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kakeibos', function (Blueprint $table) {
            // descriptionカラムにNULLを許容
            $table->string('description')->nullable()->change();
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
               // descriptionカラムにNULLを許容しない
            $table->string('description')->nullable(false)->change();
        });
    }
}
