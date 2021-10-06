<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConcernsTable extends Migration
{
    public function up()
    {
        Schema::create('concerns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId')->nullable();
            $table->string('concern');
            $table->string('status')->default('Pending');
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('concernedBy');
            $table->unsignedBigInteger('replyBy')->nullable();
            $table->timestamps();

            $table->foreign('orderId')->references('id')->on('orders');
            $table->foreign('concernedBy')->references('id')->on('users');
            $table->foreign('replyBy')->references('id')->on('users');
        });
    }

    public function down()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        Schema::dropIfExists('concerns');
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
