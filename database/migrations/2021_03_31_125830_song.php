<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Song extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id('songId');
            $table->longText('description');
            $table->string('title');
            $table->string('art');
            $table->string('song');
            $table->string('genre');
            $table->string('artist');
            $table->integer('userId');
            $table->integer('albumId')->nullable();
            $table->string('slug');
            $table->string('visible')->default(1);
            $table->integer('downloads')->default(0);
            $table->integer('views')->default(0);
            $table->integer('shares')->default(0);
            $table->dateTime('released_date')->useCurrent();
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
        //
    }
}
