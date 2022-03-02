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
        Schema::create('place_of_departures', function (Blueprint $table) {
            $table->id();
            $table->string('en')->nullable();
            $table->string('cs')->nullable();
            $table->string('pl')->nullable();
            $table->string('sk')->nullable();
            $table->string('hu')->nullable();
            $table->string('rum')->nullable();
            $table->string('de')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_of_departures');
    }
};
