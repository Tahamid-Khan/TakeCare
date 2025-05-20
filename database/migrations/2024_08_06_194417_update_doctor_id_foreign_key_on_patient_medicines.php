<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDoctorIdForeignKeyOnPatientMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing foreign key constraint
        Schema::table('patient_medicines', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
        });

        // Add the new foreign key constraint with ON DELETE CASCADE
        Schema::table('patient_medicines', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the updated foreign key constraint
        Schema::table('patient_medicines', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
        });

        // Re-add the original foreign key constraint without ON DELETE CASCADE
        Schema::table('patient_medicines', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }
}
