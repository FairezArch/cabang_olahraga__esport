<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('game_name')->nullable();
            $table->string('slug')->nullable();
            $table->text('game_description')->nullable();
            $table->text('image_game')->nullable();
            $table->text('logo_game')->nullable();
            $table->mediumText('rules')->nullable();
            $table->integer('status')->default(1);
            $table->integer('cabang_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
