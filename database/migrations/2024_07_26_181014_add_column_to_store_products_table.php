<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('store_products', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->after('id');
            $table->unsignedBigInteger('item_type_id')->after('department_id');
            $table->foreign('department_id')->references('id')->on('store_departments');
            $table->foreign('item_type_id')->references('id')->on('store_item_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('store_products', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['item_type_id']);
            $table->dropColumn(['department_id', 'item_type_id']);
        });
    }
}
