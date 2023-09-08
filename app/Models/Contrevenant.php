<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrevenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'num_id',
        'address',
        'phone',
        'email',
    ];

    /** Un contrevenant possède plusieurs véhicule */
    public function vehicule()
    {
        return $this->hasMany('App\Models\Vehicule');
    }
}
