<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->string('personnel_code')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->default(0);
            $table->date('recruitment_date')->nullable();
            $table->string('img_url')->nullable();
            $table->string('about')->nullable();
            $table->bigInteger('nominee_id')->unsigned()->nullable();
            $table->string('nominee')->nullable();
            $table->integer('gender')->default(0);
            $table->integer('level')->default(0);
            $table->bigInteger('autho')->unsigned()->nullable();
            $table->integer('level_department')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
