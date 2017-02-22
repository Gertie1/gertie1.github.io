<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseaseIncidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_incidences', function (Blueprint $table) {
            $table->increments('id');

            $table->string('disease');
            $table->string('location');
            $table->integer('year');
            $table->string('month');
            $table->integer('incidence');
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
        Schema::drop('diseases_incidences');
    }
}
