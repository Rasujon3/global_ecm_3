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
        Schema::create('productvariants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('variant_id');
            $table->string('variant_value');
            $table->string('variant_price')->nullable();
            $table->string('stock_qty');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('productvariants');
    }
};
