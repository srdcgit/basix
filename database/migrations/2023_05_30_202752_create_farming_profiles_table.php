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
        Schema::create('farming_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('respondent_master_id')->nullable();
            $table->foreign('respondent_master_id')->references('id')->on('respondent_masters')->onDelete('cascade');
            $table->boolean('shg_member')->default(0)->nullable();
            $table->boolean('fish_pb_member')->default(0)->nullable();
            $table->string('head_of_hh')->nullable();
            $table->boolean('has_hh_bpl_no')->default(0)->nullable();
            $table->boolean('has_hh_mgnrega_card')->default(0)->nullable();
            $table->boolean('has_hh_bank_account')->default(0)->nullable();
            $table->boolean('has_hh_kcc_account')->default(0)->nullable();
            $table->string('total_annual_income')->nullable();
            $table->string('total_annual_income_from_fishery')->nullable();
            $table->string('involvement_in_fishery')->nullable();
            $table->string('own_water_body')->nullable();
            $table->string('lease_in_water_body')->nullable();
            $table->string('lease_out_water_body')->nullable();
            $table->string('total_water_body')->nullable();
            $table->boolean('have_pump_set')->default(0)->nullable();
            $table->boolean('have_tube_well')->default(0)->nullable();
            $table->boolean('fishing_net')->default(0)->nullable();
            $table->boolean('aereator')->default(0)->nullable();
            $table->boolean('have_boundary_regularly')->default(0)->nullable();
            $table->boolean('have_remove_black_soil')->default(0)->nullable();
            $table->boolean('have_applied_lime')->default(0)->nullable();
            $table->boolean('have_apply_cow_dung')->default(0)->nullable();
            $table->boolean('have_regularly_apply_lime')->default(0)->nullable();
            $table->boolean('have_regularly_apply_cow_dung')->default(0)->nullable();
            $table->string('type_of_feed_used')->nullable();
            $table->boolean('done_feeding_regularly')->default(0)->nullable();
            $table->boolean('have_water_ph_regularly')->default(0)->nullable();
            $table->boolean('have_meeting_regularly')->default(0)->nullable();
            $table->boolean('attend_training_programme')->default(0)->nullable();
            $table->boolean('exposure_good_practics')->default(0)->nullable();
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
        Schema::dropIfExists('farming_profiles');
    }
};
