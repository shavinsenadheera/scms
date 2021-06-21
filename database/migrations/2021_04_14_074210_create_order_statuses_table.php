<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('status_1')->nullable();
            $table->foreign('status_1')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_1_empid')->nullable();
            $table->foreign('status_1_empid')->references('id')->on('employee');
            $table->dateTime('status_1_datetime')->nullable();
            $table->unsignedBigInteger('status_2')->nullable();
            $table->foreign('status_2')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_2_empid')->nullable();
            $table->foreign('status_2_empid')->references('id')->on('employee');
            $table->dateTime('status_2_datetime')->nullable();
            $table->unsignedBigInteger('status_3')->nullable();
            $table->foreign('status_3')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_3_empid')->nullable();
            $table->foreign('status_3_empid')->references('id')->on('employee');
            $table->dateTime('status_3_datetime')->nullable();
            $table->unsignedBigInteger('status_4')->nullable();
            $table->foreign('status_4')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_4_empid')->nullable();
            $table->foreign('status_4_empid')->references('id')->on('employee');
            $table->dateTime('status_4_datetime')->nullable();
            $table->unsignedBigInteger('status_5')->nullable();
            $table->foreign('status_5')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_5_empid')->nullable();
            $table->foreign('status_5_empid')->references('id')->on('employee');
            $table->dateTime('status_5_datetime')->nullable();
            $table->unsignedBigInteger('status_6')->nullable();
            $table->foreign('status_6')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_6_empid')->nullable();
            $table->foreign('status_6_empid')->references('id')->on('employee');
            $table->dateTime('status_6_datetime')->nullable();
            $table->unsignedBigInteger('status_7')->nullable();
            $table->foreign('status_7')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_7_empid')->nullable();
            $table->foreign('status_7_empid')->references('id')->on('employee');
            $table->dateTime('status_7_datetime')->nullable();
            $table->unsignedBigInteger('status_8')->nullable();
            $table->foreign('status_8')->references('id')->on('statuses');
            $table->unsignedBigInteger('status_8_empid')->nullable();
            $table->foreign('status_8_empid')->references('id')->on('employee');
            $table->dateTime('status_8_datetime')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
