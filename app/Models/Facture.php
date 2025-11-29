<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'patient_id',
        'numero',
        'date_facture',
        'montant',
        'fichier',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
