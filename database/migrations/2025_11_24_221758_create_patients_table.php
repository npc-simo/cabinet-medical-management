<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('patients', function (Blueprint $table) {
        $table->id('id_patient');
        $table->unsignedBigInteger('user_id'); // الربط مع users

        $table->string('nom', 100);
        $table->string('prenom', 100);
        $table->date('date_naissance')->nullable();
        $table->char('sexe', 1)->nullable(); // M / F
        $table->string('telephone', 20)->nullable();
        $table->text('adresse')->nullable();
        $table->string('cin', 50)->nullable();

        $table->timestamps();

        $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
    });
}
};
