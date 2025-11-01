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
            $table->string('bank_name')->nullable()->after('sub_urban_areas_dc');
            $table->string('branch_name')->nullable()->after('sub_urban_areas_dc');
            $table->string('routing_number')->nullable()->after('sub_urban_areas_dc');
            $table->string('acc_no')->nullable()->after('sub_urban_areas_dc');
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
