<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Exception;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        return response()->json(['ret' => 1, 'data' => Funcionario::all()]);
    }

    public function show($id) // para acessar aqui, basta passar o $id do funcionario na rota ex: funcionarios/2
    {
        $funcionario = Funcionario::funcionarioDepartamento($id);
        return response()->json(['ret' => 1, 'data' => $funcionario]);
    }

    public function store(Request $request)
    {
        // o validate serve para garantir que a requisição enviou o que é necessário para salvar o objeto
        $this->validate($request, [
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'data_nascimento' => 'required|date',
            'cargo' => 'required|string',
            'email' => 'required|string',
            'telefone' => 'required|string',
            'data_contratacao' => 'required|date',
            'departamento_id'=> 'required|integer|numeric|min:1'
        ]);

        $funcionario = Funcionario::create($request->all());

        return response()->json(['ret' => 1, 'data' => $funcionario]);
    }

    public function update($id, Request $request)
    {
        try {
        // o validate serve para garantir que a requisição enviou o que é necessário para salvar o objeto
        $this->validate($request, [
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'data_nascimento' => 'required|date',
            'cargo' => 'required|string',
            'email' => 'required|string',
            'telefone' => 'required|string',
            'data_contratacao' => 'required|date',
            'departamento_id'=> 'required|integer|numeric|min:1'
        ]);

        Funcionario::upsert(
            [
                'id' => $id, // Se você está atualizando, deve incluir a chave única
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'data_nascimento' => $request->data_nascimento,
                'cargo' => $request->cargo,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'data_contratacao' => $request->data_contratacao,
                'departamento_id' => $request->departamento_id,
            ],
            ['id'], // Chave única para verificar a existência do registro
            [
                'nome',
                'sobrenome',
                'data_nascimento',
                'cargo', // campos que serão criados ou editados
                'email',
                'telefone',
                'data_contratacao',
                'departamento_id',
            ]
        );

        return response()->json(['ret' => 1, 'msg' => 'Funcionário atualizado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['ret' => 0, 'msg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Funcionario::whereId($id)->delete();
        return response()->json(['ret' => 1, 'msg' => 'Recurso escluído com sucesso!']);
    }
}
