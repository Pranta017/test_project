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
    Schema::create('beneficiaries', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('nid')->nullable();
        $table->string('address')->nullable();
        $table->string('division')->nullable();
        $table->string('district')->nullable();
        $table->string('upazila')->nullable();
        $table->string('union')->nullable();
        $table->string('phone')->nullable();
        $table->string('gender')->nullable();
        $table->string('father')->nullable();
        $table->string('mother')->nullable();
        $table->timestamps();
    });
}


};
