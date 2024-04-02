<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;

class MarcaController extends Controller
{
    private $marca ;
    public function __construct(Marca $marca) {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $marcas = $this->marca->all();
        return response()->json($marcas,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarcaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaRequest $request)
    {
        $request->validate($this->marca->ruler(),$this->marca->feedback());
        // nesse validate, como ja diz ele valida as regras foram atendidas caso nao forem ele retorna o feedback
        // compativel com ele
        $img = $request->file('imagem');
        $pathImg = $img->store('imagens','public');
        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $pathImg        
        ]);
        return response()->json($marca,201);
    }

    /**
     * Display the specified resource.
     *
     * @param Integer valor do id
     * @return \Illuminate\Http\Response
     */
    public function show(int $marcaCodigo)
    { 
        $marca = $this->marca->find($marcaCodigo);
        if(empty($marca))
        {
            return response()->json(['msg'=>'Recurso pesquisado nao existe'],404);
        }
        return response()->json($marca,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarcaRequest $request, int $marcaCodigo)
    {
        $marca = $this->marca->find($marcaCodigo);

        if(empty($marca))
        {
            return response()->json(['msg'=>'Impossivel realizar a requisição de update'],404);
        }        
        if($request->method() == "PATCH"){
            $regrasDinamicas = array();
            foreach($marca->ruler() as $input => $regra){
                if(array_key_exists($input, $request->all())){
                   $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas,$marca->feedback());
        }else{
            $request->validate($marca->ruler(),$marca->feedback());
        }
        $marca = $marca->update($request->all());
        return response()->json($marca,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $marcaCodigo)
    {   
        $marca = $this->marca->find($marcaCodigo);
        if(empty($marca))
        {
            return response()->json(['msg'=>'Impossivel realizar a requisição de destroy'],404);
        }
        $marca->delete();
        return response()->json(['msg'=>'marca excluida carai'],200);

    }

}
