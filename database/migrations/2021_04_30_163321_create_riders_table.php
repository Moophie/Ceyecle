<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->string('picture');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob');
            $table->integer('age');
            $table->string('nationality');
            $table->float('height');
            $table->integer('weight');
            $table->integer('team_id');
            $table->integer('uci_wr');
            $table->string('pcs_url');
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
        Schema::dropIfExists('riders');
    }
}
