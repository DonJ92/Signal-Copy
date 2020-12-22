<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_account_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_id', 191);
            $table->boolean('is_real')->default(0);
            $table->string('currency')->default("");
            $table->double('unit_lots', 10, 2)->default(0);
            $table->double('balance', 10, 2)->default(0);
            $table->double('equity', 10, 2)->default(0);
            $table->double('margin', 10, 2)->default(0);
            $table->double('free_margin', 10, 2)->default(0);
            $table->double('margin_level', 10, 2)->default(0);
            $table->double('pos_profit', 10, 2)->default(0);
            $table->double('daily_profit', 10, 2)->default(0);
            $table->bigInteger('daily_trades')->default(0);
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
        Schema::dropIfExists('tbl_account_details');
    }
}
