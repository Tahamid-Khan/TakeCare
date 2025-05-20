<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreatePOWPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('p_o_w_patients');
        Schema::create('p_o_w_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operation_id');
            $table->unsignedBigInteger('doctor_id');
            $table->boolean('isReadyForWard')->default(false);
            $table->unsignedBigInteger('bed_id')->nullable();
            $table->foreign('operation_id')->references('id')->on('operations')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('bed_id')->references('id')->on('beds')->onDelete('cascade');
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
        Schema::dropIfExists('p_o_w_patients');
        Schema::create('p_o_w_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operation_id');
            $table->unsignedBigInteger('doctor_id');
            $table->boolean('isReadyForWard')->default(false);
            $table->unsignedBigInteger('bed_id')->nullable();
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('bed_id')->references('id')->on('beds');
            $table->timestamps();
        });
    }
}
