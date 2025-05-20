<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToOPDPatientSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('o_p_d_patient_serials', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed','absent'])->default('pending')->after('serial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_p_d_patient_serials', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
