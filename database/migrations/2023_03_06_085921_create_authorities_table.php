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
        Schema::create('authorities', function (Blueprint $table) {
            $table->id();
            $table->string('name_autho');
            $table->string('authority');
            $table->string('personnel', 500);
            $table->string('departments', 500);
            $table->string('equipment', 500);
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('autho')->references('id')->on('authorities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorities');
    }
};
