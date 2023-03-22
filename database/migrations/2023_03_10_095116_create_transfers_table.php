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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_transfer')->unsigned()->nullable();
            $table->bigInteger('user_recipient')->unsigned()->nullable();
            $table->date('transfer_date');
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('user_transfer')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_recipient')->references('id')->on('users')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
};
