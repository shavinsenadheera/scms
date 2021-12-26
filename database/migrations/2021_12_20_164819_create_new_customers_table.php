<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNewCustomersTable extends Migration
{
    public function up(){
        Schema::create('new_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('industry');
            $table->string('email')->unique();
            $table->string('contactNo');
            $table->string('message');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('industry')->references('id')->on('industries')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    public function down(){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('new_customers');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
