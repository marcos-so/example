<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Exception;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        return response()->json(['ret' => 1, 'data' => Departamento::all()]);
    }

    public function show($id) // para acessar aqui, basta passar o $id do departamento na rota ex: departamentos/2
    {
        return response()->json(['ret' => 1, 'data' => Departamento::whereId($id)->first()]);
    }

    public function store(Request $request)
    {
        // o validate serve para garantir que a requisição enviou o que é necessário para salvar o objeto
        $this->validate($request, [
            'nome' => 'required|string',
        ]);

        $departamento = Departamento::create($request->all());

        return response()->json(['ret' => 1, 'data' => $departamento]);
    }

    public function update($id, Request $request)
    {
        try {
        // o validate serve para garantir que a requisição enviou o que é necessário para salvar o objeto
        $this->validate($request, [
            'nome' => 'required|string',
        ]);

        Departamento::upsert(
            [
                'id' => $id, // Se você está atualizando, deve incluir a chave única
                'nome' => $request->nome,
            ],
            ['id'], // Chave única para verificar a existência do registro
            [
                'nome'
            ]
        );

        return response()->json(['ret' => 1, 'msg' => 'Departamento atualizado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['ret' => 0, 'msg' => $e->getMessage()]);
        }
    }
}
