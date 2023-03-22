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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('interviewer1')->unsigned()->nullable();
            $table->foreign('interviewer1')->references('id')->on('users');
            $table->bigInteger('interviewer2')->unsigned()->nullable();
            $table->foreign('interviewer2')->references('id')->on('users');
            $table->date('interview_date');
            $table->time('interview_time');
            $table->boolean('cate_inter')->default(true);
            $table->string('location');
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::table('curriculum_vitaes', function (Blueprint $table) {
            $table->foreign('interview_id')->references('id')->on('interviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
};
