<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('death_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('fathers_name');
            $table->string('mothers_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->date('dob');
            $table->string('gender');
            $table->boolean('isUnnatural')->default(false);
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->json('details');
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
        Schema::dropIfExists('death_certificates');
    }
}
