<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->char('emp_id');
            $table->char('name');
            $table->foreignId('department_id');
            $table->char('gender')->comment('Male,Female,Others');
            $table->date('date_of_birth');
            $table->char('religion')->comment('Muslim,Hindu,Buddhist,Christian,Others');
            $table->char('mobile_no');
            $table->char('email');
            $table->char('blood_group')->nullable()->comment('A+, A-,B+,B-,AB+,AB-,O+,O-');
            $table->date('joining_date');
            $table->text('address')->nullable();
            $table->text('showcases');
            $table->text('summery')->nullable();
            $table->string('basic_salary');
            $table->string('salary_scale');
            $table->char('type')->comment('Permanent,Temporary');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
