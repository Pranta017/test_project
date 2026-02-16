<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Division Name
            $table->string('bn_name')->nullable(); // Bangla Name
            $table->string('description')->nullable(); // Description
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status
            $table->string('url')->nullable(); // URL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
