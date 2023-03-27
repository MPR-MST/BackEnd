<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('facebookImages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->string('type');
            $table->integer('size');
            $table->string('description');
            $table->foreignId('facebook_posts_id')->references('id')->on('facebook_posts'); 
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
        Schema::dropIfExists('facebookImages');
    }
};
