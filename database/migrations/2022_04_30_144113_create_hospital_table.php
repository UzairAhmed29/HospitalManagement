<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->mediumText('address');
            $table->string('phone');
            $table->string('total_doctors')->nullable();
            $table->string('picture')->nullable();
            $table->string('consultation_fee')->nullable();
            $table->string('facilities_services');
            $table->string('active_cases');
            $table->string('deaths');
            $table->string('recovered_patients');
            $table->string('status');
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
        Schema::dropIfExists('hospitals');
    }
}


