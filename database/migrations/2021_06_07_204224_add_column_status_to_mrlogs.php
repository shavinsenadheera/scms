<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusToMrlogs extends Migration
{
    public function up()
    {
        Schema::table('m_r_logs', function (Blueprint $table) {
            $table->integer('status')->default(0);
        });
    }

    public function down()
    {
        Schema::table('m_r_logs', function (Blueprint $table) {
            $table->dropcolumn('status');
        });
    }
}
