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
        Schema::create('farming_yearlings', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('figerlings')->nullable();
            $table->string('yearlings')->nullable();
            $table->foreignId('farming_profile_id')->nullable();
            $table->foreign('farming_profile_id')->references('id')->on('farming_profiles')->onDelete('cascade');
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
        Schema::dropIfExists('farming_yearlings');
    }
};
