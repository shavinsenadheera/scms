<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRLogsTable extends Migration
{
    public function up()
    {
        Schema::create('m_r_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('materials_id');
            $table->foreign('materials_id')->references('id')->on('materials');
            $table->integer('request_count');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_r_logs');
    }
}
