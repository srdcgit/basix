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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('executive_id')->nullable()->after('user_id');
            $table->foreign('executive_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('field_staff_id')->nullable()->after('user_id');
            $table->foreign('field_staff_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('executive_id');
            $table->dropColumn('field_staff_id');
        });
    }
};
