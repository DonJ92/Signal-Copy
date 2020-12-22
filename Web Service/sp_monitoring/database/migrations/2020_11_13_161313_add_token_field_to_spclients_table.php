<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenFieldToSpclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tbl_spclient', function (Blueprint $table) {
            $table->string('token')->after('signal_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('tbl_spclient', function (Blueprint $table) {
            $table->dropColumn([
                'deposit'
            ]);
        });
    }
}
