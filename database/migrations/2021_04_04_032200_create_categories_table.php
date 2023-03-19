<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('c_name');
            $table->integer('c_parent_id')->nullable()->default(0)->index();
            $table->string('c_slug')->unique();
            $table->string('c_avatar')->nullable();
            $table->string('c_banner')->nullable();
            $table->string('c_description')->nullable();
            $table->tinyInteger('c_hot')->default(0);
            $table->tinyInteger('c_status')->default(1);
            $table->tinyInteger('c_type')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
