<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('emp_histories', function (Blueprint $table) {
            $table->string('document')->nullable()->after('history');
        });
    }

    public function down(): void
    {
        Schema::table('emp_histories', function (Blueprint $table) {
            $table->dropColumn('document');
        });
    }
};
