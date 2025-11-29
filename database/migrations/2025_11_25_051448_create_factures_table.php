<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');

            $table->string('numero');
            $table->date('date_facture');
            $table->decimal('montant', 8, 2);

            $table->string('fichier')->nullable();

            $table->timestamps();

            $table->foreign('patient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('factures');
    }
};
