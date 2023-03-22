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
        Schema::create('detail_equipment_transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_equipment_detail')->unsigned()->nullable();
            $table->bigInteger('id_equipment_tranfer')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_equipment_detail')->references('id')->on('equipment_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_equipment_transfers');
    }
};
