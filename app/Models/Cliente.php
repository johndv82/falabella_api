<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombres', 'apellidos', 'celular', 'tipodoc', 'numdoc', 'email'
    ];
}
