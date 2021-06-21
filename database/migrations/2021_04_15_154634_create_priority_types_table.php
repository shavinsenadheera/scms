<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('priority_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('priority_types');
    }
}
