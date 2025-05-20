<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('car_number');
            $table->string('contact_number');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->enum('type', ['internal', 'external']);
            $table->enum('category',['basic', 'basic_o2', 'icu', 'freezer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('isOnRoute')->default(false);
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete(null);
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
        Schema::dropIfExists('ambulances');
    }
}
