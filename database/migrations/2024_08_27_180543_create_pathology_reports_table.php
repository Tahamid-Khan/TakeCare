<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathologyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathology_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pathology_id');
            $table->json('test_results');
            $table->text('remarks')->nullable();
            $table->json('file')->nullable();
            $table->foreign('pathology_id')->references('id')->on('pathologies')->onDelete('cascade');
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
        Schema::dropIfExists('pathology_reports');
    }
}
