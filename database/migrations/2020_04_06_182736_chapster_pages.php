<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChapsterPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Chapster_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page');
            $table->integer('chapster_id')->unsigned()->index();
            $table->foreign('chapster_id')->references('id')->on('manga_chapster')->onDelete('cascade');
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
