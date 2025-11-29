<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $table = 'rendezvous';
    protected $primaryKey = 'id_rv';
    public $timestamps = true; // عندك created_at / updated_at ف الجدول

    protected $fillable = [
        'id_patient',
        'id_medecin',
        'id_secretaire',
        'date_rv',
        'heure_rv',
        'statut',
        'motif',
        'date_creation',
        'date_validation',
        'valide_par',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient');
    }
}
