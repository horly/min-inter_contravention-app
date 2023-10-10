<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraction extends Model
{
    use HasFactory;

    protected $table = "infractions";

    protected $fillable = [
        'name',
        'devise',
        'price',
    ];
}
