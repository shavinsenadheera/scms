<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeightAndWidthColumnToLabelSizes extends Migration{
    public function up(){
        Schema::table('label_sizes', function (Blueprint $table) {
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
        });
    }
    public function down(){
        Schema::table('label_sizes', function (Blueprint $table) {
            $table->dropColumn('width');
            $table->dropColumn('height');
        });
    }
}
