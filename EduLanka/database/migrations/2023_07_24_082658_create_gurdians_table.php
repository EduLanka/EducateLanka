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
        Schema::create('gurdians', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id')->unique();
                $table->string('guardian_name');
                $table->string('guardian_telno');
                $table->string('guardian_busniess');
                $table->string('guardian_email');
                $table->integer('role')->default(2);
                $table->string('password')->default('aaAA12!@');
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                $table->rememberToken();
                $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurdians');
    }
};
