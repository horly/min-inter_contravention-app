<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'marque',
        'model',
        'num_matricule',
        'usage',
        'id_contrevenant',
    ];

    /** Un véhicule appartient à un contrevenant */
    function contrevenant()
    {
        return $this->belongsTo('App\Models\Contrevenant', 'id_contrevenant');
    }

    /** Un véhicule possède plusieurs infractions */
    public function amande()
    {
        return $this->hasMany('App\Models\Amande');
    }
}
