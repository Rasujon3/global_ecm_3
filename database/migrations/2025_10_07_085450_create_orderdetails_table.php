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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('paymentmethod_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('full_address');
            $table->string('screen_shot')->nullable();
            $table->string('sub_total');
            $table->string('delivery_charge')->default('0')->nullable();
            $table->string('vat_tax')->default('0')->nullable();
            $table->string('total');
            $table->date('date');
            $table->string('time');
            $table->string('timestamp');
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('orderdetails');
    }
};
