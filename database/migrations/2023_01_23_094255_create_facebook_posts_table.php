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
        Schema::create('facebook_posts', function (Blueprint $table) {
            $table->id();
            $table->string("tittle",255)->nullable();
            $table->string("date",50)->nullable();
            $table->string("url",255)->nullable();
            $table->boolean("active")->default(true);
            $table->text("content")->nullable();
            $table->timestamps();
            /*  It is a way of performing a logical deletion of records instead of physically removing them from the database, 
                allowing the deleted records to be recovered if necessary.*/
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facebook_posts');
    }
};
