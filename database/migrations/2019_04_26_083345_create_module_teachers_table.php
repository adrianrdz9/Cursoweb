<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_teachers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');

            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')->references('id')->on('modules');

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
        Schema::dropIfExists('module_teachers');
    }
}
