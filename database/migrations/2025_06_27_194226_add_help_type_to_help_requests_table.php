<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('help_requests', function (Blueprint $table) {
        $table->string('help_type')->nullable();  // or ->default('') if you want
    });
}

public function down()
{
    Schema::table('help_requests', function (Blueprint $table) {
        $table->dropColumn('help_type');
    });
}

};
