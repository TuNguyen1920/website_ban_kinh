<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPcClotheToProductCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_carts', function (Blueprint $table) {
            //
            $table->string('pc_clothes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_carts', function (Blueprint $table) {
            //
            $table->dropColumn('pc_clothes');
        });
    }
}
