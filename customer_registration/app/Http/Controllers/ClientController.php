<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(Client $client){
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = $this->client->all();
        return response()->json($client,200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*lembrando de incluir o accept no Header na aplicação Client para que seja 
        posivel receber a validação via JSON*/
        $regras = [
            'email'=>'unique:clients',
            'cpf_cnpj'=>'unique:clients',
            'rg'=>'unique:clients'
        ];
        $feedback = [
            'unique' => 'O :attribute do cliente já existe'
            ];

        $request->validate($regras,$feedback);
        $client = $this->client->create($request->all());
        return response()->json($client,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->client->find($id);
        if ($client === null) {
            return response()->json(['msg' => 'Registro pesquisado não exite'],404);
        }
        return response()->json($client,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = $this->client->find($id);

        if ($client === null) {
            return response()->json(['msg' => 'Impossivel realizar a atualização! Registro não encontrado.'],404);
        }

        /*lembrando de incluir o accept no Header na aplicação Client para que seja 
        posivel receber a validação via JSON*/
        $regras = [
            'email'=>'unique:clients',
            'cpf_cnpj'=>'unique:clients',
            'rg'=>'unique:clients'
        ];
        $feedback = [
            'unique' => 'O :attribute do cliente já existe'
            ];

        $request->validate($regras,$feedback);

        $client->update($request->all());
        return response()->json($client,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $client = $this->client->find($id);
        
        if ($client === null) {
            return response()->json(['msg' => 'Impossivel realizar a exclusão! Registro não encontrado.'],404);
        }

        $client->delete(); 
        return response()->json(['msg' => 'O cliente foi deletado!'],200);
    }
}
