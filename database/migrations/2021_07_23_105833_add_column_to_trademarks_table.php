<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTrademarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trademarks', function (Blueprint $table) {
            //
            $table->string('td_email', 255)->nullable()->after('td_description');
            $table->string('td_phone', 15)->nullable()->after('td_email');
            $table->string('td_address', 15)->nullable()->after('td_phone');
            $table->string('td_fax', 15)->nullable()->after('td_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trademarks', function (Blueprint $table) {
            //
        });
    }
}
