<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndustryColumnToCustomers extends Migration
{
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->unsignedBigInteger('industry')->default(1);
            $table->foreign('industry')->references('id')->on('industries');
        });
    }
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn('industry');
        });
    }
}
