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
        Schema::create('pond_preparations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('respondent_master_id')->nullable();
            $table->foreign('respondent_master_id')->references('id')->on('respondent_masters')->onDelete('cascade');
            $table->timestamp('date_of_update')->nullable();
            $table->string('location')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->boolean('repair_pond_boundary')->default(0)->nullable();
            $table->date('date_of_pond_boundary')->nullable();
            $table->string('expenditure_of_pond_boundary')->nullable();
            $table->string('observation_of_pond_boundary')->nullable();
            $table->boolean('remove_black_soil')->default(0)->nullable();
            $table->date('date_black_soil')->nullable();
            $table->string('expenditure_black_soil')->nullable();
            $table->string('observation_of_black_soil')->nullable();
            $table->boolean('is_sun_drying')->default(0)->nullable();
            $table->date('from_sun_drying')->nullable();
            $table->date('to_sun_drying')->nullable();
            $table->boolean('is_done_liming')->default(0)->nullable();
            $table->string('done_liming_quantity')->nullable();
            $table->string('done_liming_rate')->nullable();
            $table->string('done_liming_expenditure')->nullable();
            $table->boolean('is_cow_dung')->default(0)->nullable();
            $table->string('cow_dung_quantity')->nullable();
            $table->string('cow_dung_rate')->nullable();
            $table->string('cow_dung_expenditure')->nullable();
            $table->boolean('is_apply_npk')->default(0)->nullable();
            $table->string('urea_quantity')->nullable();
            $table->string('urea_rate')->nullable();
            $table->string('urea_expenditure')->nullable();
            $table->string('ssp_quantity')->nullable();
            $table->string('ssp_rate')->nullable();
            $table->string('ssp_expenditure')->nullable();
            $table->string('potas_quantity')->nullable();
            $table->string('potas_rate')->nullable();
            $table->string('potas_expenditure')->nullable();
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
        Schema::dropIfExists('pond_preparations');
    }
};
