<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTevekenysegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tevekenysegs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tevekenyseg_nev',50);
            $table->integer('pontszam');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tevekenysegs');
    }
}
