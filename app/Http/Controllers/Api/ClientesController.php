<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct(Clientes $cliente)
    {
        $this->cliente = $cliente;

        $this->validation = [
            'Nome' => ['required', 'string'],
            'Telefone' => ['required', 'string'],
            'CPF' => ['required', 'cpf'],
            'PlacaCarro' => ['required', 'string'],
        ];

        $this->feedback = [
            'Nome.required' => 'Nome é um campo obrigatório.',
            'Telefone.required' => 'Telefone é um campo obrigatório.',
            'CPF.required' => 'CPF é um campo obrigatório.',
            'CPF.cpf' => 'CPF em um formato inválido. Formatos permitidos: 100.100.100-10 ou 10010010010.',
            'PlacaCarro.required' => 'Placa do Carro é um campo obrigatório.',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->cliente->paginate(10);
    }

    /**
     * Clientes a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            
            $request->validate($this->validation, $this->feedback);

            return $this->cliente->create($request->all());
        } catch (\Illuminate\Validation\ValidationException $e) {
            
            return response()->json(['error' => $e->errors()], 422);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $cliente = Clientes::findOrFail($id);
            return $cliente;

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(['error' => 'Cliente não encontrado'], 404);

        }
        
    }

     /**
     * Display the specified resource.
     */
    public function showPlacaCarro(Clientes $cliente, $numero)
    {
 
        try {
            $clientes = $cliente->whereRaw("SUBSTRING(PlacaCarro, -1) = ?", [$numero])->get();

            if ($clientes->isEmpty()) {
                return response()->json(['error' => 'Nenhum cliente encontrado com a placa correspondente'], 404);
            }

            return $clientes;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro durante a consulta'], 500);
        }
       
    }

    /**
     * @param Clientes $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $cliente)
    {
        try {
            
            $request->validate($this->validation, $this->feedback);

            $cliente->update($request->all());
            return response()->json(['success' => 'Cliente Editado com sucesso'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            
            return response()->json(['error' => $e->errors()], 422);

        }
        
    }

    /**
     * @param Clientes $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $cliente)
    {
        try {
            
            $cliente->delete();

            return response()->json(['success' => 'Cliente Deletado com sucesso'], 200);

        } catch (\Exception $e) {
            
            return response()->json(['error' => $e->errors()], 404);

        }

        
    }
}
