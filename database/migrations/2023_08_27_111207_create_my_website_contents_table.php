<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyWebsiteContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_website_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('my_website_id')->nullable();
            $table->string('content_code')->nullable();
            $table->longText('data')->nullable();
            $table->timestamps();

            $table->foreign('my_website_id')->references('id')->on('my_website')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_website_contents');
    }
}
