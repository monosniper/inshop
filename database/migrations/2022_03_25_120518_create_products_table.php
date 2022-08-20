<?php

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Shop::class);
            $table->foreignIdFor(Category::class);
            $table->string('title', 255);
            $table->string('subtitle', 255)->nullable();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->text('description')->nullable();
            $table->integer('inStock')->default(0);
            $table->json('properties')->nullable();
            $table->string('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
