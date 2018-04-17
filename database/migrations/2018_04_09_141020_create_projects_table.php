<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv_projekta');
            $table->string('opis_projekta');
            $table->integer('voditelj_id');
            $table->double('cijena_projekta');
            $table->mediumText('obavljeni_poslovi');
            $table->dateTime('datum_pocetka');
            $table->dateTime('datum_zavrsetka');
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
        Schema::dropIfExists('projects');
    }
}
