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
        Schema::create('monthly_farming_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('respondent_master_id')->nullable();
            $table->foreign('respondent_master_id')->references('id')->on('respondent_masters')->onDelete('cascade');
            $table->timestamp('date_of_update')->nullable();
            $table->string('month')->nullable();
            $table->string('location')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->boolean('is_stocking')->default(0)->nullable();
            $table->string('catia_fry')->nullable();
            $table->string('rahu_fry')->nullable();
            $table->string('mirgal_fry')->nullable();
            $table->string('common_carp_fry')->nullable();
            $table->string('other_fry')->nullable();
            $table->string('hr_fry')->nullable();
            $table->string('fry_quantity')->nullable();
            $table->string('fry_rate')->nullable();
            $table->string('fry_amount')->nullable();
            $table->boolean('is_hydrological')->default(0)->nullable();
            $table->string('temp')->nullable();
            $table->string('ph')->nullable();
            $table->string('do')->nullable();
            $table->string('transperency')->nullable();
            $table->string('water_depth')->nullable();
            $table->boolean('is_providing_feed')->default(0)->nullable();
            $table->string('number_of_feed')->nullable();
            $table->string('mash_feed_quantity')->nullable();
            $table->string('mash_feed_rate')->nullable();
            $table->string('mash_feed_amount')->nullable();
            $table->string('commerical_feed_quantity')->nullable();
            $table->string('commerical_feed_rate')->nullable();
            $table->string('commerical_feed_amount')->nullable();
            $table->string('mineral_quantity')->nullable();
            $table->string('mineral_rate')->nullable();
            $table->string('mineral_amount')->nullable();
            $table->boolean('is_lime_applied')->default(0)->nullable();
            $table->string('lime_quantity')->nullable();
            $table->string('lime_rate')->nullable();
            $table->string('lime_amount')->nullable();
            $table->boolean('is_netting')->default(0)->nullable();
            $table->string('c')->nullable();
            $table->string('r')->nullable();
            $table->string('m')->nullable();
            $table->string('cc')->nullable();
            $table->string('o')->nullable();
            $table->boolean('is_bath')->default(0)->nullable();
            $table->string('disease')->nullable();
            $table->string('action_for_disease')->nullable();
            $table->string('netting_expenditure')->nullable();
            $table->string('fish_quantity')->nullable();
            $table->string('fish_rate')->nullable();
            $table->string('fish_amount')->nullable();
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
        Schema::dropIfExists('monthly_farming_reports');
    }
};
