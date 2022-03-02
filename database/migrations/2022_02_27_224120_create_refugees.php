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
        Schema::create('refugees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('place_of_departure_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->unsignedInteger('people_in_group');
            $table->unsignedInteger('adults_in_group');
            $table->unsignedInteger('kids_in_group');
            $table->text('note')->nullable();
            $table->string('gender',1);

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('age');
            $table->boolean('has_whatsapp')->default(0);
            $table->boolean('has_signal')->default(0);
            $table->boolean('has_telegram')->default(0);
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
        Schema::dropIfExists('refugees');
    }
};
