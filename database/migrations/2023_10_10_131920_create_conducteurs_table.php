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
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('num_id', 255);
            $table->string('address', 255);
            $table->string('phone', 255);
            $table->string('email', 255);
            $table->bigInteger('id_vehicule')->unsigned()->index();
            $table->foreign('id_vehicule')
                    ->references('id')->on('vehicules')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conducteurs');
    }
};
