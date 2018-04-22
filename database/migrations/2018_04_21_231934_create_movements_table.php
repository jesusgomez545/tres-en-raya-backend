<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('round_id');
            
            $table->timestamps();
            $table->integer('x_axis');
            $table->integer('y_axis');
            $table->boolean('wining');
            $table->enum('player', ['x', 'o', 'r']);

            $table->foreign('round_id')
            ->references('id')->on('rounds')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
