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
        Schema::create('refugee_companion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->unsignedInteger('age');
            $table->string('gender',1);
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
        Schema::dropIfExists('refugee_companion');
    }
};
