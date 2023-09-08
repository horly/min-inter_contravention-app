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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255);
            $table->string('marque', 255);
            $table->string('model', 255);
            $table->string('num_matricule', 255);
            $table->string('usage', 255);

            $table->bigInteger('id_contrevenant')->unsigned()->index();
            $table->foreign('id_contrevenant')
                    ->references('id')->on('contrevenants')
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
        Schema::dropIfExists('vehicules');
    }
};
