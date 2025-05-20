<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICUPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_c_u_patients', function (Blueprint $table) {
            $table->id();
            // patient_id, isICU, bed_id, doctor_id, refrredHospital, isDischarged
            $table->unsignedBigInteger('patient_id');
            $table->boolean('isICU')->default(true);
            $table->unsignedBigInteger('bed_id')->nullable();
            $table->unsignedBigInteger('doctor_id');
            $table->string('referredHospital')->nullable();
            $table->boolean('isDischarged')->default(false);
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('bed_id')->references('id')->on('beds');
            $table->foreign('doctor_id')->references('id')->on('doctors');
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
        Schema::dropIfExists('i_c_u_patients');
    }
}
