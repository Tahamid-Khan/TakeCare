<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('nurses', function (Blueprint $table) {
            $table->unsignedBigInteger('ward_id')->nullable()->after('user_id');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('nurses', function (Blueprint $table) {
            $table->dropForeign(['ward_id']);
            $table->dropColumn('ward_id');
        });
    }
};
