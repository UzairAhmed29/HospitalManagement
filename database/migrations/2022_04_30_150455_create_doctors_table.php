<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('hospital_id');
            $table->string('picture')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('expirience');
            $table->string('education');
            $table->string('city');
            $table->string('working_days');
            $table->string('timming');
            $table->string('services');
            $table->string('bio')->nullable();
            $table->string('fee');
            $table->string('specialist');
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
        Schema::dropIfExists('doctors');
    }
}
