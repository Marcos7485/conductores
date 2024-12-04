<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'autos';

    protected $fillable = [
        'comprobante',
        'conductores',
        'data',
        'marca',
        'modelo',
        'modelo_2',
        'organismo',
        'patente',
        'poliza',
        'active'
    ];
}
