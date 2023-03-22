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
        Schema::create('equipment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_equipment')->unsigned()->nullable();
            $table->string('imei')->nullable()->unique();
            $table->string('equipment_code')->unique();
            $table->date('warranty_expiration_date');
            $table->string('img')->nullable();
            $table->integer('status')->default(0);
            $table->string('specifications', 1000);
            $table->date('date_added');
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('id_equipment')->references('id')->on('equipment')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_details');
    }
};
