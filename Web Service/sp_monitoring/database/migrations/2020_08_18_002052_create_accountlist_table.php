<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_account_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id', 191);
            $table->unsignedInteger('broker_id');
            $table->string('account_id', 191);
            $table->timestamp('register_date')->nullable();
            $table->timestamp('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_account_list');
    }
}
