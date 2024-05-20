<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'db_exemplo.funcionarios';
    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'cargo',
        'departamento_id',
        'email',
        'telefone',
        'data_contratacao'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // criando relacionamento com o departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public static function funcionarioDepartamento($funcionarioId)
    {
        // dd($funcionarioId);
        return self::whereId($funcionarioId)
            ->with('departamento')
            ->first();
    }
}
