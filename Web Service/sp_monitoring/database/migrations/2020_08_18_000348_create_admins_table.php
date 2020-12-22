<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->string('email', 30);
            $table->string('password', 191);
            $table->string('remember_token', 191)->nullable();
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
        Schema::dropIfExists('admins');
    }
}
