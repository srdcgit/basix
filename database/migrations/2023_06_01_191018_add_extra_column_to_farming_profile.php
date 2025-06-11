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
            $table->string('shg_member_name')->nullable();
            $table->string('fish_pb_member_name')->nullable();
            $table->foreignId('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
            $table->dropColumn('shg_member_name');
            $table->dropColumn('fish_pb_member_name');
            $table->dropColumn('project_id');
        });
    }
};
