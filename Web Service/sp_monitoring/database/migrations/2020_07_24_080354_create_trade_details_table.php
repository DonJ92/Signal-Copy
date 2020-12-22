<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trade_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_id', 191);
            $table->string('symbol', 20);
            $table->double('pos_profit_s', 10, 2)->default(0);
            $table->double('pos_profit_b', 10, 2)->default(0);
            $table->unsignedBigInteger('pos_cnt_s')->default(0);
            $table->unsignedBigInteger('pos_cnt_b')->default(0);
            $table->double('pos_lots_s', 10, 2)->default(0);
            $table->double('pos_lots_b', 10, 2)->default(0);
            $table->unsignedBigInteger('lmt_cnt_s')->default(0);
            $table->unsignedBigInteger('lmt_cnt_b')->default(0);
            $table->double('lmt_lots_s', 10, 2)->default(0);
            $table->double('lmt_lots_b', 10, 2)->default(0);
            $table->unsignedBigInteger('stp_cnt_s')->default(0);
            $table->unsignedBigInteger('stp_cnt_b')->default(0);
            $table->double('stp_lots_s', 10, 2)->default(0);
            $table->double('stp_lots_b', 10, 2)->default(0);
            $table->timestamps();

            $table->index('account_id', 'symbol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_trade_details');
    }
}
