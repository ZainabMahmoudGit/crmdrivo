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
       Schema::create('contractors', function (Blueprint $table) {
    $table->string('id')->primary(); // Firebase UID
    $table->string('name');
    $table->string('nationality');
    $table->string('city')->nullable();
    $table->string('phone')->nullable();
     $table->string('email')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
