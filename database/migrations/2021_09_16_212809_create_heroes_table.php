<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('clan_id')->nullable();
            $table->string('slug')->unique();
            $table->string('image', 2048)->nullable();
            $table->string('video')->nullable();
            $table->string('icon', 2048)->nullable();
            $table->text('stats')->nullable();
            $table->text('skills')->nullable();
            $table->text('desc')->nullable();
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('heroes');
    }
}
