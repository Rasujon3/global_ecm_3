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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('welcome_msg')->nullable()->after('bank_name');
            $table->string('shop_name')->nullable()->after('bank_name');
            $table->string('copyright_msg')->nullable()->after('bank_name');
            $table->string('footer_title')->nullable()->after('bank_name');
            $table->string('footer_description')->nullable()->after('bank_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
