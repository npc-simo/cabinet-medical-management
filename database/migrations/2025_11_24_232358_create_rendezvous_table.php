<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id('id_rv');                 // PK
            $table->unsignedBigInteger('id_patient');   // FK -> patients.id_patient
            $table->unsignedBigInteger('id_medecin')->nullable();    // FK -> medecins.id_medecin (plus tard)
            $table->unsignedBigInteger('id_secretaire')->nullable(); // FK -> secretaires.id_secretaire (plus tard)

            $table->date('date_rv');
            $table->time('heure_rv');
            $table->string('statut', 50)->default('En attente');
            $table->text('motif')->nullable();

            $table->dateTime('date_creation')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('date_validation')->nullable();
            $table->string('valide_par', 100)->nullable();

            $table->timestamps();

            $table->foreign('id_patient')
                  ->references('id_patient')
                  ->on('patients')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};
