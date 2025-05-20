<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('age')->nullable()->after('email');
//            shift_time
            $table->string('shift_time')->nullable()->after('age');
//            account_no
            $table->string('account_no')->nullable()->after('shift_time');
//            present_work_position
            $table->string('present_work_position')->nullable()->after('account_no');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->dropColumn('shift_time');
            $table->dropColumn('account_no');
            $table->dropColumn('present_work_position');
        });
    }
};
