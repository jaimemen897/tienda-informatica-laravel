<?php

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->float('price');
            $table->string('stock');
            $table->string('image');
            $table->string('description');
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->foreignIdFor(Supplier::class)->constrained('suppliers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
