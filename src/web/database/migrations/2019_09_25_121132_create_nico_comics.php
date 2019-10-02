<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNicoComics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nico_comics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->string('author');
            $table->text('description');

            $table->json('tags_json');

            $table->integer('nico_no');
            $table->integer('story_number');

            $table->date('comic_start_date');
            $table->date('comic_update_date');


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
        Schema::dropIfExists('nico_comics');
    }
}
