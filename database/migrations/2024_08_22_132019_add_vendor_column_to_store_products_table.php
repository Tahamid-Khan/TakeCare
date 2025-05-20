<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorColumnToStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_products', function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id')->after('id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('store_vendors')->onDelete(null);
            $table->integer('low_inventory')->after('vendor_id')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_products', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn(['vendor_id']);
            $table->dropColumn(['low_inventory']);
        });
    }
}
