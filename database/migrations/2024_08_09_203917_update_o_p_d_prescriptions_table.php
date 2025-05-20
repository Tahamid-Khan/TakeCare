<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOPDPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('o_p_d_prescriptions', function (Blueprint $table) {
            $table->dropForeign(['opd_patient_id']);
            $table->dropColumn('opd_patient_id');
            $table->unsignedBigInteger('patient_id')->after('id');
            $table->foreign('patient_id')->references('id')->on('o_p_d_patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_p_d_prescriptions', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropColumn('patient_id');
            $table->unsignedBigInteger('opd_patient_id');
            $table->foreign('opd_patient_id')->references('id')->on('o_p_d_patients')->onDelete('cascade');
        });
    }
}
