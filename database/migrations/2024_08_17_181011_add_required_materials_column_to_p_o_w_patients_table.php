<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequiredMaterialsColumnToPOWPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_o_w_patients', function (Blueprint $table) {
            $table->json('required_materials')->nullable()->after('bed_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_o_w_patients', function (Blueprint $table) {
            $table->dropColumn('required_materials');
        });
    }
}
