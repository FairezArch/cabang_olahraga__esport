<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOriganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('origanizations', function (Blueprint $table) {
            $table->id();
            $table->string('name_club')->nullable();
            $table->string('owner_club')->nullable();
            $table->text('desc')->nullable();
            $table->string('team_name')->nullable();
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
        Schema::dropIfExists('origanizations');
    }
}
