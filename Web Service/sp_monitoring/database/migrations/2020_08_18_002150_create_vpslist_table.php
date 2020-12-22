<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVpslistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_vps_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vps_name', 191);
            $table->string('customer_id', 191);
            $table->string('vps_ip', 191);
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
        Schema::dropIfExists('tbl_vps_list');
    }
}
