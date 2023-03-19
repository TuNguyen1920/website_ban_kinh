<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPvPriceToProductValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_values', function (Blueprint $table) {
            //
            $table->integer('pv_price')->default(0)->after('pv_value_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_values', function (Blueprint $table) {
            //
            $table->dropColumn('pv_price');
        });
    }
}
