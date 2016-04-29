<?php

namespace Ticket\Http\Controllers;

use Mockery\Exception;
use Ticket\Caixa;
use Ticket\Unidade;
use Illuminate\Http\Request;
use Ticket\Http\Requests;
use Ticket\Http\Controllers\ontroller;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $unidade = Unidade::orderBy('cd_unidade', 'ASC')->get();
        return view('restaurante.restaurante', ['unidades' => $unidade]);
    }

    /**
     * Lista de todas as unidades ordenadas pelo cd_unidade.
     *
     * @return Response
     */
    public function lista()
    {
        $unidade = Unidade::orderBy('cd_unidade', 'ASC')->get();
        return view('restaurante.lista', ['unidades' => $unidade]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('restaurante.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $r)
    {
        $this->validate($r, [
           'nm_unidade' => 'required|min:3|max:60',
        ]);

        $input = $r->all();

        //funcao para pegaro ultimo id
        $last = Unidade::orderBy('cd_unidade', 'desc')->take(1)->get()->first();
        $input['cd_unidade']=$last['cd_unidade']+1;
        $input['nr_sequencia']=0;
        Unidade::create($input);
        return redirect('restaurante/lista');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('restaurante.edit', ['restaurante' => \Ticket\Unidade::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $r, $id)
    {
        $this->validate($r, [
            'nm_unidade' => 'required|min:3|max:60',
        ]);

        unidade::find($id)->update($r->all());
        return redirect('restaurante/lista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function excluir($id)
    {
        try{
            $unidade = Unidade::find($id);
            $unidade->delete();

            return redirect('restaurante/lista');

        }catch (\Illuminate\Database\QueryException $e){

            return redirect('restaurante/lista') -> with('message', 'Unidade não pode ser excluida devido a dependências');
        }


    }

    public function ajuda(){
        return view('restaurante.ajuda');
    }

}





