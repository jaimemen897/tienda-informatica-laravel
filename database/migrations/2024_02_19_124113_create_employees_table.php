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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->decimal('salary', 8, 2);
            $table->enum('position', ['Manager', 'Developer', 'Designer', 'Tester', 'Sales']);
            $table->string('email')->unique();
            $table->string('image')->default('https://icon-library.com/images/anonymous-icon/anonymous-icon-0.jpg');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
