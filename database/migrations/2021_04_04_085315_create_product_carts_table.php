<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_carts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pc_cart_id')->index()->nullable(0);
            $table->foreign('pc_cart_id')->references('id')->on('carts')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('pc_product_id')->index()->nullable(0);
            $table->foreign('pc_product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('pc_name', 255)->nullable();
            $table->integer('pc_price')->default(0);
            $table->integer('pc_qty')->nullable();
            $table->integer('pc_sale')->nullable();
            $table->text('options')->nullable();
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
        Schema::dropIfExists('product_carts');
    }
}
