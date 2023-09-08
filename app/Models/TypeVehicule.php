<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /** Un type est affecté à plusieurs vehicules */
    public function vehicules()
    {
        return $this->hasMany('App\Models\Vehicule');
    }
}
