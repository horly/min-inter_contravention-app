<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amande extends Model
{
    use HasFactory;

    protected $fillable = [
        'infraction',
        'devise',
        'montant',
        'id_vehicule',
    ];

     /** Une amande appartient à un véhicule */
     function vehicule()
     {
         return $this->belongsTo('App\Models\Vehicule', 'id_vehicule');
     }
}
