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
        Schema::create('voters', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('cnic')->unique();
        $table->string('reg_no')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
