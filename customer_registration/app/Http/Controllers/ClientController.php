<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Repositories\ClientRepository;
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
    public function index(Request $request)
    {
        $clientRepository = new ClientRepository($this->client);
        
        if($request->has('filter')) {
            $clientRepository->filter($request->filter); 
        }

        if($request->has('attribute')) {
            $clientRepository->selectAttributes($request->attribute);
        }
        
        return response()->json($clientRepository->getResult(), 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->client->rules(),$this->client->feedback());

        $client = $this->client->create($request->all());
        
        return response()->json(['registro'=>$client, 'msg'=> 'O registro foi criado com sucesso!'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function view($id)
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

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            //pecorrendo todas as regras definidas no Model
            foreach ($client->rules() as $input => $regras) {
                
                //coletar apenas as regras aplicaveis aos parametros parciais da requisição 
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regras;
                }
            }

            $request->validate($regrasDinamicas, $client->feedback());

        }else {
            $request->validate($client->rules(),$client->feedback());
        }

        $client->fill($request->all());
        $client->save();
        return response()->json(['registro'=>$client,'msg'=> 'O registro foi alterado com sucesso!'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
        $client = $this->client->find($id);
        
        if ($client === null) {
            return response()->json(['msg' => 'Impossivel realizar a exclusão! Registro não encontrado.'],404);
        }

        $client->delete(); 
        return response()->json(['msg' => 'O cliente foi deletado!'],200);
    }
}
