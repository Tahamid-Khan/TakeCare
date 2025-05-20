<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFundDepartmentIdColumnToPatientInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('fund_department_id')->after('invoice_date');
            $table->foreign('fund_department_id')->references('id')->on('fund_departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_invoices', function (Blueprint $table) {
            $table->dropForeign(['fund_department_id']);
            $table->dropColumn('fund_department_id');
        });
    }
}
