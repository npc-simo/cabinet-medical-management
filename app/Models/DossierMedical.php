<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierMedical extends Model
{
    protected $table = 'dossiers_medicaux';

    protected $fillable = [
        'patient_id',
        'description',
        'fichier',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
