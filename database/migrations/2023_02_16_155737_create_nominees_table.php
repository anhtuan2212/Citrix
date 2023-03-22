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
        Schema::create('nominees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->string('nominees');
            $table->timestamps();
        });

        Schema::table('curriculum_vitaes', function (Blueprint $table) {
            $table->foreign('nominee')->references('id')->on('nominees')->onDelete('set null');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('nominee_id')->references('id')->on('nominees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominees');
    }
};
