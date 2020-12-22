<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_spclient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id');
            $table->string('client_id', 191);
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('vps_id');
            $table->boolean('signal_type')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamp('register_date')->nullable();;
            $table->timestamp('update_date')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_spclient', function (Blueprint $table) {
            //
        });
    }
}
