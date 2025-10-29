<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->unsignedBigInteger('combination_id')->nullable()->after('combination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->dropColumn('combination_id');
        });
    }
};
