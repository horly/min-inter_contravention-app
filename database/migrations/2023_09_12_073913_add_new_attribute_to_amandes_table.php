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
        Schema::table('amandes', function (Blueprint $table) {
            //
            $table->string('status', 255)->default('NO_PAIED')->after('montant');
            $table->string('code', 255)->nullable();
            $table->string('token', 255)->nullable();

            $table->bigInteger('id_poste')->unsigned()->index();
            $table->foreign('id_poste')
                    ->references('id')->on('police_postes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('amandes', function (Blueprint $table) {
            //
        });
    }
};
