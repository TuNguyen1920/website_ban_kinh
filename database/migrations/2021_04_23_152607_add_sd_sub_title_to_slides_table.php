<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSdSubTitleToSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {
            //
            $table->string('sd_sub_title')->after('sd_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            //
            $table->dropColumn('sd_sub_title');
        });
    }
}
