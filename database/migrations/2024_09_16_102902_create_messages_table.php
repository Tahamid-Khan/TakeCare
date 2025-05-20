<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('to');
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('user_id');
            $table->string('subject');
            $table->text('message');
            $table->string('attachment')->nullable();
            $table->timestamps();

            $table->foreign('to')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
