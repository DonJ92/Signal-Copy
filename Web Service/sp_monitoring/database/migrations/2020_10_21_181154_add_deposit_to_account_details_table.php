<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepositToAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tbl_account_details', function (Blueprint $table) {
            $table->double('deposit', 10, 2)->after('unit_lots')->default(0);
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
        Schema::table('tbl_account_details', function (Blueprint $table) {
            $table->dropColumn([
                'deposit'
            ]);
        });
    }
}
