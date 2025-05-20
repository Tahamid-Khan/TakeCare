<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherStaffInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_staff_info', function (Blueprint $table) {
            $table->id();
            $table->char('hr_type')->comment('Teacher,Staff');
            $table->char('serial');
            $table->char('hr_id');
            $table->char('hr_name');
            $table->char('designation')->comment('Head Teacher,Asst. Head Teacher,Teacher,Asst. Teacher,Office Staff,Peon');
            $table->char('gender')->comment('Male,Female,Others');
            $table->date('date_of_birth');
            $table->char('religion')->comment('Muslim,Hindu,Buddhist,Christian,Others');
            $table->char('mobile_no');
            $table->char('email');
            $table->char('blood_group')->nullable()->comment('A+, A-,B+,B-,AB+,AB-,O+,O-');
            $table->date('joining_date');
            $table->text('previous_institute')->nullable();
            $table->text('pressent_address');
            $table->text('permanent_address');
            $table->char('hr_father_name',180)->nullable();
            $table->char('hr_mother_name',180)->nullable();
            $table->string('basic_salary');
            $table->string('provident_fund');
            $table->string('coaching')->nullable();
            $table->string('hr_photo')->nullable();
            $table->string('hr_sign')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0 = inactive,1= active');

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
        Schema::dropIfExists('teacher_staff_info');
    }
}
