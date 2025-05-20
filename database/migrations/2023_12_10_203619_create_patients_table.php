<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->foreignId('cavin_ward_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('patient_id');
            $table->char('gender')->comment('Male,Female,Others');
            $table->string('age');
            $table->char('blood_group')->nullable()->comment('A+, A-,B+,B-,AB+,AB-,O+,O-');
            $table->string('mobile');
            $table->string('guardian_mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('disease');
            $table->string('patient_summary');
            $table->char('patient_type')->comment('General,CBD');
            $table->char('department')->comment('OT,Pathology');
            $table->char('reference')->nullable()->comment('DMSC,MOD,MED,CBD');
            $table->string('advance')->nullable();
            $table->string('due')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
