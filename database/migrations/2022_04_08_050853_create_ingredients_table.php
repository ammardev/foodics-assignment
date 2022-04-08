<?php

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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('inserted_amount')->comment('The amount added by the merchant to the stock. Gram unit');
            $table->integer('current_amount')->comment('Current amount in the stock. Gram unit');
            $table->boolean('amount_alert_sent')->default(false);
            $table->timestamps();
        });

        Schema::create('products_ingredients', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ingredient_id')->constrained()->cascadeOnDelete();
            $table->primary(['product_id', 'ingredient_id']);

            $table->integer('needed_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_ingredients');
        Schema::dropIfExists('ingredients');
    }
};
