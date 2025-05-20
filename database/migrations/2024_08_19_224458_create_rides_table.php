<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ambulance_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('ambulance_number')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('pickup_location');
            $table->string('destination')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('patient_phone')->nullable();
            $table->text('patient_summary')->nullable();
            $table->integer('charge')->nullable();
            $table->enum('status', ['pending','completed'])->default('pending');
            $table->foreign('ambulance_id')->references('id')->on('ambulances')->onDelete(null);
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete(null);
            $table->softDeletes();
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
        Schema::dropIfExists('rides');
    }
}
