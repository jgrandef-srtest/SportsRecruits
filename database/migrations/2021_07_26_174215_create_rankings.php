<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	Schema::enableForeignKeyConstraints();

        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
	    $table->unsignedInteger('user_id');
	    $table->unsignedTinyInteger('ranking');
            $table->timestamp('created_at');
        });


	// This probably wouldn't hurt either
        Schema::table('rankings', function (Blueprint $table) {
    	    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
