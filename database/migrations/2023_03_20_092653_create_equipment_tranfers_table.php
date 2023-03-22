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
        Schema::create('equipment_tranfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_equipment')->unsigned()->nullable();
            $table->bigInteger('id_tranfer')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_equipment')->references('id')->on('equipment')->onDelete('set null');
            $table->foreign('id_tranfer')->references('id')->on('transfers')->onDelete('set null');
        });
        Schema::table('detail_equipment_transfers', function (Blueprint $table) {
            $table->foreign('id_equipment_tranfer')->references('id')->on('equipment_tranfers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_tranfers');
    }
};
