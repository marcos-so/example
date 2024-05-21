<?php

namespace App\Models;

use App\Services\NotificationService;
use App\sqs\SnsDispatchNotification;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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
        return self::whereId($funcionarioId)
            ->with('departamento')
            ->first();
    }

    public static function notify($message)
    {
        $uuid = Uuid::uuid4()->toString();

        $reference = [
            'type' => 'Tec. info.',
            'id' => $uuid
        ];
        $userIds = [10,20,30,40,50];

        $data = NotificationService::builder($message)
            ->user($userIds)
            ->reference($reference)
            ->build();
        SnsDispatchNotification::notify($data);
    }
}
