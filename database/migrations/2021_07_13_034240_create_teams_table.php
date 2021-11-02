<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->default(0);
            $table->string('team_name')->nullable();
            $table->string('slogan')->nullable();
            $table->text('desc')->nullable();
            $table->text('file')->nullable();
            $table->text('cover')->nullable();
            $table->string('games')->nullable();
            $table->string('members')->nullable();
            $table->string('leader_team')->nullable();
            $table->integer('club_id')->default(0);
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
        Schema::dropIfExists('teams');
    }
}
