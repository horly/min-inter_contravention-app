<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amande extends Model
{
    use HasFactory;

    protected $table = "amandes";

    protected $fillable = [
        'devise',
        'montant',
        'id_vehicule',
        'id_infraction',
        'id_user',
        'id_poste',
        'id_conduct',
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

    /** Une amande est affecté un user */
    function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    /** Une amande est établi dans un poste */
    function poste()
    {
        return $this->belongsTo('App\Models\PolicePoste', 'id_poste');
    }

    /** Une amande appartient à un véhicule */
    function conducteur()
    {
        return $this->belongsTo('App\Models\Conducteur', 'id_conduct');
    }
}
