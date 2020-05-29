<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminTable extends Migration
{
    /**
     * Run the migrations.
     *admin_id admin_name admin_pwd admin_tel admin_email admin_time admin_img
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
             $table->increments('admin_id'); 
             $table->string('admin_name'); 
             $table->string('admin_pwd'); 
             $table->char('admin_pwd');
             $table->char('admin_pwd');
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
        //
    }
}
