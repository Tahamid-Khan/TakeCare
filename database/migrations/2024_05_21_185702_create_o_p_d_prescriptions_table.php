<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPDPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_p_d_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_patient_id');
            $table->foreign('opd_patient_id')->references('id')->on('o_p_d_patients')->onDelete('cascade');
            $table->unsignedBigInteger('opd_patient_serial_id');
            $table->foreign('opd_patient_serial_id')->references('id')->on('o_p_d_patient_serials')->onDelete('cascade');
            $table->json('prescription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('o_p_d_prescriptions');
    }
}
