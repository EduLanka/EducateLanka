<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submission_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->date('uploadDate')->default(DB::raw('CURRENT_DATE')); //doesnt work so changed manually
            $table->date('dueDate');
            $table->string('marks_available');
            $table->integer('num_submissions')->default(0);;
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_links');
    }
};
