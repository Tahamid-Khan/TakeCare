<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToPatientDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_discharges', function (Blueprint $table) {
            $table->dateTime('discharge_date')->nullable()->change();
            $table->json('details')->nullable()->change();
            $table->enum('status',['pending', 'generated', 'doctor_approved', 'reception_approved'])->default('pending')->after('discharge_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_discharges', function (Blueprint $table) {
            $table->dropColumn('status');

        });
    }
}
