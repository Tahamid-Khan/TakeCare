<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('department')->nullable()->change();
            $table->string('disease')->nullable()->change();
            $table->string('patient_summary')->nullable()->change();
            $table->dropForeign('patients_cavin_ward_id_foreign');
            $table->dropColumn('cavin_ward_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('department')->nullable(false)->change();
            $table->string('disease')->nullable(false)->change();
            $table->string('patient_summary')->nullable(false)->change();
            $table->unsignedBigInteger('cavin_ward_id');
            $table->foreign('cavin_ward_id')->references('id')->on('cavin_wards');

        });
    }
}
