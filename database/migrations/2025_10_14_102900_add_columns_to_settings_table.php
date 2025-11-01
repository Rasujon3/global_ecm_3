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
            $table->integer('sub_urban_areas_dc')->nullable()->default(120)->after('contact_us_img');
            $table->integer('outside_dhaka_dc')->nullable()->default(150)->after('contact_us_img');
            $table->integer('inside_dhaka_dc')->nullable()->default(80)->after('contact_us_img');
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
