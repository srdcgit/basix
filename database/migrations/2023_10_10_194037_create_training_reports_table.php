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
        Schema::create('training_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_event')->nullable();
            $table->string('geo_location')->nullable();
            $table->string('level_of_training')->nullable();
            $table->string('type')->nullable();
            $table->string('facilitator_name')->nullable();
            $table->boolean('is_co_facilitator_name')->default(0)->nullable();
            $table->string('co_facilitator_name')->nullable();
            $table->string('name')->nullable();
            $table->string('objective')->nullable();
            $table->string('type_of_participants')->nullable();
            $table->integer('number_of_participants')->nullable();
            $table->integer('number_of_male')->nullable();
            $table->integer('number_of_female')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreignId('block_id')->nullable();
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->foreignId('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');    
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
        Schema::dropIfExists('training_reports');
    }
};
