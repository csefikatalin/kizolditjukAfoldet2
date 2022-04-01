<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBejegyzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bejegyzes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('allapot'); //1 - jóváhagyva, 0 - nincs jóváhagyva
            $table->integer('tevekenysegId');
            $table->integer('osztalyokID');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bejegyzes');
    }
}
