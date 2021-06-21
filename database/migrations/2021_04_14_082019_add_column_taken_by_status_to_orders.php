<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTakenByStatusToOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('taken_by')->nullable();
            $table->foreign('taken_by')->references('id')->on('employee');
            $table->unsignedBigInteger('current_status_id')->nullable();
            $table->foreign('current_status_id')->references('id')->on('statuses');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('taken_by');
            $table->dropColumn('current_status_id');
        });
    }
}
