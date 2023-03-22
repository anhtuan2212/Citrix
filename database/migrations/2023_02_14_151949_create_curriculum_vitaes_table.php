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
        Schema::create('curriculum_vitaes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->bigInteger('nominee')->unsigned()->nullable();
            $table->integer('gender')->default(0);
            $table->string('point')->nullable();
            $table->string('about')->nullable();
            $table->string('offer')->nullable();
            $table->integer('status')->default(0);
            $table->string('note')->nullable();
            $table->string('url_cv');
            $table->bigInteger('interview_id')->unsigned()->nullable();
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
        Schema::dropIfExists('curriculum_vitaes');
    }
};
