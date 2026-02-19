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
        $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
        $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
        $table->foreignId('upazila_id')->constrained('upazilas')->onDelete('cascade');
        $table->string('union')->nullable();
        $table->string('phone')->nullable();
        $table->string('gender')->nullable();
        $table->string('father')->nullable();
        $table->string('mother')->nullable();
        $table->timestamps();
    });
}


};
