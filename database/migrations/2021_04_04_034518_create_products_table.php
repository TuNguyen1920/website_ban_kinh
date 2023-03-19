<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('pro_name')->nullable()->index();
            $table->string('pro_slug')->index()->unique();
            $table->integer('pro_price')->default(0);
            $table->integer('pro_price_entry')->default(0)->comment('giá nhập');
            $table->tinyInteger('pro_sale')->default(0)->nullable();
            $table->string('pro_avatar')->nullable();
            $table->integer('pro_view')->default(0)->nullable();
            $table->tinyInteger('pro_hot')->index()->default(0);
            $table->tinyInteger('pro_active')->index()->default(1);
            $table->integer('pro_pay')->nullable()->default(0);
            $table->mediumText('pro_description')->nullable();
            $table->text('pro_content')->nullable();
            $table->text('pro_specifications')->nullable();
            $table->integer('pro_review_total')->nullable();
            $table->integer('pro_review_star')->nullable();
            $table->text('pro_keywords')->nullable();
            $table->integer('pro_number')->default(0)->nullable();
            $table->unsignedBigInteger('pro_category_id')->nullable();
            $table->unsignedBigInteger('pro_user_id')->nullable();

            $table->foreign('pro_category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('pro_user_id')->references('id')->on('users')
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
        Schema::dropIfExists('products');
    }
}
