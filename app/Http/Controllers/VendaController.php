<?php

namespace Ticket\Http\Controllers;

use Illuminate\Http\Request;

use Monolog\Handler\NullHandlerTest;
use Ticket\Caixa;
use Ticket\Http\Requests;
use Ticket\Http\Controllers\Controller;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data_dia = date('Y-m-d');
        $caixa_dia = Caixa::where('ticket_caixa.cd_unidade', '=', $id)
            ->where('ticket_caixa.dt_atividade', '=', $data_dia)
            ->get();

        $tabela = $this->categoria($id);


        if(count($caixa_dia)){


            return view('venda.venda',['restaurante' => \Ticket\Unidade::find($id), 'tabela' => $tabela]);

        }else{

            return redirect('caixa/'.$id.'/create') -> with('message', 'O caixa ainda não foi aberto.');
        }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function categoria($id){

        $tabela = \Ticket\Ticket_Custo_Categoria::join('ticket_categoria', 'ticket_custo_categoria.cd_unidade', '=', 'ticket_categoria.cd_unidade')
            ->whereRaw('ticket_custo_categoria.cd_categoria = ticket_categoria.cd_categoria')
            ->where('ticket_categoria.cd_unidade', '=', $id)
            ->where('dt_fim_vigencia', '=', null)
            ->orderBy('ticket_categoria.cd_categoria')
            ->get();

        return $tabela;
    }

    public function buscaServidor(Request $request){

        $nome =$request->nome;

        $consulta = DB::statement(pessoas($nome));
        var_dump($consulta);

    }
}

