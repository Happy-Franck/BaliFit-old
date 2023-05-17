<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sceance_training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('sceance_id');
            $table->integer('series')->nullable();
            $table->integer('repetitions')->nullable();
            $table->integer('duree')->nullable();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('sceance_id')->references('id')->on('sceances')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sceance_training');
    }
};
