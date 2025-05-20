<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPDPatientSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_p_d_patient_serials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_patient_id');
            $table->foreign('opd_patient_id')->references('id')->on('o_p_d_patients')->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->integer('serial');
            $table->enum('cluster', ['C Board', 'General']);
            $table->integer('amount');
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
        Schema::dropIfExists('o_p_d_patient_serials');
    }
}
