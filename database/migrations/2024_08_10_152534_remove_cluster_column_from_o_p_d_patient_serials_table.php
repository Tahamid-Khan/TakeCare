<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveClusterColumnFromOPDPatientSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('o_p_d_patient_serials', function (Blueprint $table) {
            $table->dropColumn('cluster');
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
            $table->string('cluster');
        });
    }
}
