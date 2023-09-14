<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicePoste extends Model
{
    use HasFactory;

    protected $table = "police_postes";

    protected $fillable = [
        'name',
    ];

    /** Un poste de police possède à plusieurs utilisateurs */
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    /** Un poste de police possède à plusieurs amandes */
    public function amandes()
    {
        return $this->hasMany('App\Models\Amande');
    }
}
