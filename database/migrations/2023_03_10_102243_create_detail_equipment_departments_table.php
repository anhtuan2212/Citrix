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
        Schema::create('detail_equipment_departments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('equipment_detail_id')->unsigned()->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->bigInteger('transfer_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('equipment_detail_id')->references('id')->on('equipment_details')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('set null');
        });

        





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_equipment_departments');
    }
};
