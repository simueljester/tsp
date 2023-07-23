<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('introductions', function (Blueprint $table) {
            //
            $table->string('logo')->nullable()->after('description')->default('default-logo.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('introductions', function (Blueprint $table) {
            //
            $table->dropColumn('logo');
        });
    }
}
