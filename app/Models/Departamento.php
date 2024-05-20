<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'db_exemplo.departamentos';
    protected $fillable = [
        'nome'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
