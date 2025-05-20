<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('emp_histories', function (Blueprint $table) {
            $table->longText('history')->change();
        });
    }

    public function down(): void
    {
        Schema::table('emp_histories', function (Blueprint $table) {
            $table->text('history')->change();
        });
    }
};
