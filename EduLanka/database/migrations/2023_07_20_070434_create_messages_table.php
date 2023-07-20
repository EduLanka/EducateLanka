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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->string('description');
            $table->unsignedBigInteger('sender');
            $table->timestamps();

            $table->foreign('sender')
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); // If you want the message to be deleted when the corresponding user is deleted, you can set onDelete('cascade')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
