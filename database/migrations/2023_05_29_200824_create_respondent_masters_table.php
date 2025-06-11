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
        Schema::create('respondent_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('education')->nullable();
            $table->string('number_family_member')->nullable();
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('farmer_id')->nullable();
            $table->foreignId('block_id')->nullable();
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->foreignId('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreignId('gram_panchyat_id')->nullable();
            $table->foreign('gram_panchyat_id')->references('id')->on('gram_panchyats')->onDelete('cascade');
            $table->foreignId('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
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
        Schema::dropIfExists('respondent_masters');
    }
};
