<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name')->nullable();
            $table->string('student_email')->nullable();
            $table->enum('student_gender', ['Male', 'Female']);
            $table->string('student_image')->nullable();
            $table->string('collage_id')->nullable();
            $table->string('course_id')->nullable();
            $table->timestamps();

            // $table->foreign('collage_id')->references('id')->on('collages');
            // $table->foreign('course_id')->references('id')->on('courses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
