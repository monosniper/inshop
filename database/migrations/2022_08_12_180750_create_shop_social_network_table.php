<?php

use App\Models\Shop;
use App\Models\SocialNetwork;
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
        Schema::create('shop_social_network', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Shop::class);
            $table->foreignIdFor(SocialNetwork::class);
            $table->string('value', 2048)->nullable();
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
        Schema::dropIfExists('shop_social_network');
    }
};
