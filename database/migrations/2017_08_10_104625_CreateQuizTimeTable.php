<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Quiz_Time_Management', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->foreign('quiz_id')->references('id')->on('Quiz');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('User');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
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
        Schema::dropIfExists('Quiz_Time_Management');
    }
}
