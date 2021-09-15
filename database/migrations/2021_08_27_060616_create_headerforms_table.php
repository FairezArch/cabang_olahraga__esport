<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headerforms', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('branch_id')->default(0);
            $table->string('header_title')->nullable();
            $table->longText('question_n_answer')->nullable();
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
        Schema::dropIfExists('headerforms');
    }
}
