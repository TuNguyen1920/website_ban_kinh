<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPcTransactionIdToProductCartsTable extends Migration
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
            $table->unsignedBigInteger('pc_transaction_id')->nullable()->after('pc_product_id');

            $table->foreign('pc_transaction_id')->references('id')->on('transactions')
                ->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropColumn('pc_transaction_id');
        });
    }
}
