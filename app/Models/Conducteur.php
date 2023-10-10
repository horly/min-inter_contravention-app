<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{
    use HasFactory;

    protected $table = "conducteurs";

    protected $fillable = [
        'name',
        'num_id',
        'address',
        'phone',
        'email',
        'id_vehicule'
    ];

    /** Un conducteur conduit un vehicule */
    function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule', 'id_vehicule');
    }

     /** Un grade peut être affecté à plusieurs utilisateurs */
     public function amande()
     {
        return $this->hasMany('App\Models\Amande');
     }
}
