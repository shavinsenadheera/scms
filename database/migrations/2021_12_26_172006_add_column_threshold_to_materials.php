<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnThresholdToMaterials extends Migration{
    public function up(){
        Schema::table('materials', function (Blueprint $table) {
            $table->integer('threshold');
        });
    }

    public function down(){
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('threshold');
        });
    }
}
