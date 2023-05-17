<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sceances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('coach_id');
            $table->unsignedBigInteger('challenger_id');
            $table->boolean('validated');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('challenger_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sceances');
    }
};
