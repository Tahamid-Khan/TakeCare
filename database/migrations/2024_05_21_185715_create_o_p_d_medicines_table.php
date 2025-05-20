<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPDMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_p_d_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_prescription_id');
            $table->foreign('opd_prescription_id')->references('id')->on('o_p_d_prescriptions')->onDelete('cascade');
            $table->string('name');
            $table->string('dose');
            $table->string('schedule');
            $table->string('taking_time');
            $table->string('duration');
            $table->enum('store_type', ['CentralStore', 'OutdoorStore']);
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
        Schema::dropIfExists('o_p_d_medicines');
    }
}
