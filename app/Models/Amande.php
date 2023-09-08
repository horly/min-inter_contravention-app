<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amande extends Model
{
    use HasFactory;

    protected $fillable = [
        'devise',
        'montant',
        'id_vehicule',
        'id_infraction',
    ];

    /** Une amande appartient à un véhicule */
    function vehicule()
    {
         return $this->belongsTo('App\Models\Vehicule', 'id_vehicule');
    }

    /** Une amande est affecté une contravention */
    function infraction()
    {
        return $this->belongsTo('App\Models\Infraction', 'id_infraction');
    }
}
