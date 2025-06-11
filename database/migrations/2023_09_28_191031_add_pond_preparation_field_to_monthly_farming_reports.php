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
        Schema::table('monthly_farming_reports', function (Blueprint $table) {
            $table->boolean('is_pond_preparation')->nullable()->before('created_at');
            $table->string('boundary_cleaning_expenditure')->nullable()->before('created_at');
            $table->string('fym_application_expenditure')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monthly_farming_reports', function (Blueprint $table) {
            $table->dropColumn('is_pond_preparation');
            $table->dropColumn('boundary_cleaning_expenditure');
            $table->dropColumn('fym_application_expenditure');
        });
    }
};
