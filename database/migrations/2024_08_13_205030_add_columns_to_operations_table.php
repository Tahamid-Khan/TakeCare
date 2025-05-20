<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operations', function (Blueprint $table) {
//            isRequested, requestedBy
            $table->boolean('isRequested')->default(false);
//            service_id
            $table->unsignedBigInteger('service_id')->after('patient_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('requestedBy')->nullable();
            $table->foreign('requestedBy')->references('id')->on('doctors')->onDelete('cascade');
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
            $table->dropColumn('isRequested');
            $table->dropColumn('service_id');
            $table->dropColumn('requestedBy');
        });
    }
}
