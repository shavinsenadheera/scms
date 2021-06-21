<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('m_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('suppliers_id');
            $table->foreign('suppliers_id')->references('id')->on('suppliers');
            $table->unsignedBigInteger('materials_id');
            $table->foreign('materials_id')->references('id')->on('materials');
            $table->integer('total_count');
            $table->integer('item_price');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_transactions');
    }
}
