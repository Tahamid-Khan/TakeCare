<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            // patient_id, iscomplete, doctor_id, operation_date, operation_time
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->boolean('iscomplete')->default(false);
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->date('operation_date');
            $table->time('operation_time');
            $table->string('operation_name')->nullable();
            $table->string('operation_type')->nullable();
            $table->string('operation_status')->nullable();
            $table->string('operation_result')->nullable();
            $table->string('operation_remarks')->nullable();
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
        Schema::dropIfExists('operations');
    }
}
