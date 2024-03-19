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
        return $marcas;
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
        $marca = $this->marca->create($request->all());
        return $marca;
        
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
        return $marca;
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
        $marca = $marca->update($request->all());
        return $marca;
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
        $marca->delete();
        return ['msg'=>'marca excluida carai'];
    }

}
