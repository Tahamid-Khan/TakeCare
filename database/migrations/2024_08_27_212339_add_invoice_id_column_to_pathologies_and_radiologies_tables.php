<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceIdColumnToPathologiesAndRadiologiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pathologies', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->nullable()->after('id');
            $table->foreign('invoice_id')->references('id')->on('patient_invoices')->onDelete('cascade');
        });

        Schema::table('radiologies', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->nullable()->after('id');
            $table->foreign('invoice_id')->references('id')->on('patient_invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pathologies', function (Blueprint $table) {
            $table->dropForeign(['invoice_id']);
            $table->dropColumn('invoice_id');
        });

        Schema::table('radiologies', function (Blueprint $table) {
            $table->dropForeign(['invoice_id']);
            $table->dropColumn('invoice_id');
        });
    }
}
