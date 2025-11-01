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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('brand_id')->nullable(); 
            $table->integer('subcategory_id')->nullable();
            $table->integer('unit_id');
            $table->string('product_name')->unique();
            $table->string('product_price');
            $table->string('discount')->nullable();
            $table->string('stock_qty');
            $table->string('image');
            $table->text('description');
            $table->enum('status', ['Active', 'Inactive']);
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
