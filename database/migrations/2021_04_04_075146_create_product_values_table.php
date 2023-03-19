<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pv_product_id');
            $table->unsignedBigInteger('pv_value_id');

            $table->foreign('pv_product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pv_value_id')->references('id')->on('values')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_values');
    }
}
