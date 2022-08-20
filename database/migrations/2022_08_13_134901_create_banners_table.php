<?php

use App\Models\Banner;
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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Shop::class);
            $table->integer('order');
            $table->enum('type', Banner::TYPES);
            $table->string('title', 100)->nullable();
            $table->string('text', 400)->nullable();
            $table->string('background')->nullable();
            $table->string('color')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link', 2048)->nullable();
            $table->string('button_background')->nullable();
            $table->string('button_color')->nullable();
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
        Schema::dropIfExists('banners');
    }
};
