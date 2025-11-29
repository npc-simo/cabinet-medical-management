<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medecin_id')->nullable();

            $table->text('contenu');
            $table->string('fichier')->nullable();

            $table->timestamps();

            $table->foreign('patient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('medecin_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordonnances');
    }
};
