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
        Schema::table('farming_profiles', function (Blueprint $table) {
            $table->string('api_id')->nullable()->before('created_at');
            $table->string('respondent_master_api_id')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farming_profiles', function (Blueprint $table) {
            $table->dropColumn('api_id');
            $table->dropColumn('respondent_master_api_id');
        });
    }
};
