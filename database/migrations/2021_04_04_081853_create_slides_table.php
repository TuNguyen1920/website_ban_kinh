<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('sd_title')->nullable();
            $table->string('sd_link')->nullable();
            $table->string('sd_image')->nullable();
            $table->string('sd_target', 100)->nullable(1);
            $table->tinyInteger('sd_active')->default(1);
            $table->tinyInteger('sd_sort')->default(1);
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
        Schema::dropIfExists('slides');
    }
}
