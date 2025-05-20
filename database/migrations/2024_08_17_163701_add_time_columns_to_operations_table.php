<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeColumnsToOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->dropColumn('operation_name');
            $table->dropColumn('operation_type');
            $table->dropColumn('operation_status');
            $table->dropColumn('operation_remarks');
            $table->dropColumn('operation_result');

            $table->time('operation_start_time')->nullable()->after('operation_time');
            $table->time('anesthesia_given_time')->nullable()->after('operation_start_time');
            $table->time('operation_end_time')->nullable()->after('anesthesia_given_time');
            $table->string('remarks')->nullable()->after('operation_end_time');
            $table->json('materials_used')->nullable()->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->string('operation_name')->nullable();
            $table->string('operation_type')->nullable();
            $table->string('operation_status')->nullable();
            $table->string('operation_remarks')->nullable();
            $table->string('operation_result')->nullable();

            $table->dropColumn('operation_start_time');
            $table->dropColumn('anesthesia_given_time');
            $table->dropColumn('operation_end_time');
            $table->dropColumn('remarks');
            $table->dropColumn('materials_used');
        });
    }
}
