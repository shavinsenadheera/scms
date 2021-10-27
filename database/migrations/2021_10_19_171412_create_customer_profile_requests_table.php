<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomerProfileRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_profile_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerID');
            $table->string('name');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->integer('zipcode');
            $table->string('telephone_no');
            $table->string('telephone_land');
            $table->string('telephone_fax');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('acceptedBy')->nullable();
            $table->unsignedBigInteger('rejectedBy')->nullable();
            $table->timestamps();
            $table->foreign('customerID')->references('id')->on('customer');
            $table->foreign('acceptedBy')->references('id')->on('users');
            $table->foreign('rejectedBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('customer_profile_requests');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
