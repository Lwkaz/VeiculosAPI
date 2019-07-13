<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veiculo;
use App\Marca;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $veiculo = new Veiculo();
            $veiculo->ano_lancamento = $request->input('ano_lancamento');
            $veiculo->marca = $request->input('marca');
            $veiculo->descricao = $request->input('descricao');
            $veiculo->tipo_veiculo = $request->input('tipo_veiculo');
            $veiculo->imagem = $request->input('imagem');
            $veiculo->save();
            return array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculos = Veiculo::find($id);
        $marca = Marca::find($veiculos->marca);
        $veiculos["nome_marca"] = $marca->nome;
        if (isset($veiculos)) {
            return json_encode($veiculos);            
        }
        return response('Produto não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$idveiculo = $request->input('id');
        try{
            $veiculo = Veiculo::find($id);
            if(isset($veiculo)){
                $veiculo->ano_lancamento = $request->input('ano_lancamento');
                $veiculo->marca = $request->input('marca');
                $veiculo->descricao = $request->input('descricao');
                $veiculo->tipo_veiculo = $request->input('tipo_veiculo');
                $veiculo->imagem = $request->input('imagem');

                $marca = Marca::find($veiculo->marca);
                $marca->nome = $request->input('nome_marca');

                $veiculo->save();
                $marca->save();
                return array();
            }
        } catch(Exception $e) {
                return array();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculos = Veiculo::find($id);
        if (isset($veiculos)) {
            $veiculos->delete();
            return response('OK', 200);
        }
        return response('Veículo não encontrado', 404);
    }

    public function getAll() {
        $veiculos = Veiculo::all();
        $marcas = Marca::all();

        foreach($veiculos as $veiculo) {
            foreach($marcas as $marca) {
                if($veiculo->marca == $marca->id) {
                    $veiculo['nome_marca'] = $marca->nome;
                }
            }
        }
        return json_encode($veiculos);
    }
}
