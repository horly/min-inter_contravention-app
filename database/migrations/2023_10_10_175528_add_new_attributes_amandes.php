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
            $table->bigInteger('id_conduct')->unsigned()->index();
            $table->foreign('id_conduct')
                    ->references('id')->on('conducteurs')
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
