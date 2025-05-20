<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->date('invoice_date')->default(now());
            $table->string('service_name');
            $table->decimal('total_price', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('final_price', 8, 2);
            $table->decimal('due_amount', 8, 2);
            $table->string('payment_status');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('patient_invoices');
    }
}
