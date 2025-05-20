<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nurse_id');
            $table->enum('type', ['pow_nurse', 'opd_nurse', 'icu_nurse', 'ot_nurse', 'emergency_nurse', 'pathology_test_nurse','radiology_test_nurse']);
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('position')->nullable();
            $table->string('qualification')->nullable();
            $table->string('employee_status')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};
