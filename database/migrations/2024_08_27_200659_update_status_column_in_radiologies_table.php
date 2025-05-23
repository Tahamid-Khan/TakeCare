<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInRadiologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radiologies', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('radiologies', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed', 'generated', 'delivered', 'cancelled'])->default('pending')->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radiologies', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('radiologies', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed', 'delivered', 'cancelled'])->default('pending')->after('remarks');
        });
    }
}
