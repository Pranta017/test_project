<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('districts', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('bn_name')->nullable();
    $table->text('description')->nullable();
    $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
    $table->enum('status', ['active','inactive'])->default('active');
    $table->string('url')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
