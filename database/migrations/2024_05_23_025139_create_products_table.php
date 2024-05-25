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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->integer('price');
            $table->integer('stock');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('image')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');
            $table->enum('criteria', ['perorangan', 'rombongan', 'terusan'])->default('perorangan');
            //favorite
            $table->boolean('is_favorite')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
