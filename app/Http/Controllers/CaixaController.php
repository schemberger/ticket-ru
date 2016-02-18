<?php

namespace Ticket\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery\Exception;
use Illuminate\Http\Request;
use Ticket\Http\Requests;
use Ticket\Http\Controllers\Controller;
use Ticket\Ticket_Venda_Vista;
use Ticket\Caixa;

class CaixaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * A funcao index recebe o id da unidade em que foi selecionada e envia para a view a data atual, caso selecionada outra data,
     *  a rota é direcionada para a funcao show recebendo o id da unidade e o mes e o ano por request.
     */
    public function index($id)
    {
        $mes = date("m");//mes atual
        $ano = date("Y"); // Ano atual
        $data_ini = $ano . "-" . $mes . "-1";
        $last_day = cal_days_in_month(CAL_GREGORIAN, $mes, $ano); //pega o ultimo dia do mes
        $data_fim = $ano . "-" . $mes . "-" . $last_day;

        $caixas = \Ticket\Caixa::where('dt_atividade', '>=', $data_ini)
            ->where('dt_atividade', '<=', $data_fim)
            ->where('cd_unidade', '=', $id)
            ->orderBy('dt_atividade', 'DESC')->get();

        $vendaDia = $this->tabelaCaixa($id, $data_ini, $data_fim);

        $m = array('01' => "Janeiro", '02' => "Fevereiro", '03' => "Março", '04' => "Abril", '05' => "Maio", '06' => "Junho",
            '07' => "Julho", '08' => "Agosto", '09' => "Setembro", '10' => "Outubro", '11' => "Novembro", '12' => "Dezembro");

        return view('caixa.index', ['restaurante' => \Ticket\Unidade::find($id), 'caixa' => $caixas, 'venda_dia'=> $vendaDia, 'mes' => $m[$mes]]);
    }

    /**
     * Show the form for creating a new resource.f
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Respon
     */
    public function show($id, Request $data)
    {

        $mes = $data->input('mes');
        $ano = $data->input('ano');

        if ($mes > 0 && $mes < 13 && $ano != 0) {

            $data_ini = $ano . "-" . $mes . "-1";
            $last_day = cal_days_in_month(CAL_GREGORIAN, $mes, $ano); //pegar o ultimo dia do mes
            $data_fim = $ano . "-" . $mes . "-" . $last_day;

            $caixas = \Ticket\Caixa::where('ticket_caixa.dt_atividade', '>=', $data_ini)
                ->where('ticket_caixa.dt_atividade', '<=', $data_fim)
                ->where('ticket_caixa.cd_unidade', '=', $id)
                ->orderBy('ticket_caixa.dt_atividade', 'DESC')->get();

            $vendaDia = $this->tabelaCaixa($id, $data_ini, $data_fim);

            return view('caixa.caixa', ['restaurante' => \Ticket\Unidade::find($id), 'caixa' => $caixas, 'venda_dia' => $vendaDia, 'msg' => 'ok']);

        } else {

            return view('caixa.caixa', ['restaurante' => \Ticket\Unidade::find($id), 'msg' => 'erro']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *git
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function caixaAtual($id)
    {

        /**
         * A querry abaixo faz uma pesquisa e retorna o valor do troco da ultima data inserida
         */
        try{

            $vl_troco = \Ticket\Caixa::select('vl_troco')
                ->orderBy('ticket_caixa.dt_atividade', 'desc')
                ->where('ticket_caixa.cd_unidade', '=', $id)
                ->take(1)->get()->first();

            //var_dump($vl_troco);

            return view('caixa.caixaAtual',['restaurante' => \Ticket\Unidade::find($id)],  compact('vl_troco'));

        }catch (\Illuminate\Database\QueryException $e){

            return redirect('caixa.caixa', ['restaurante' => \Ticket\Unidade::find($id)]) -> with('message', 'Criar view para fazer cadastro de caixa');

        }

    }

    /**
     * @param $id
     * @param $data_ini
     * @param $data_fim
     * @return retorna a querry para select do valor da venda do dia
     */
    public function tabelaCaixa($id, $data_ini, $data_fim){

        $soma = \Ticket\Ticket_Custo_Categoria::join('ticket_venda_vista', 'ticket_custo_categoria.cd_unidade', '=', 'ticket_venda_vista.cd_unidade')
            ->whereRaw('ticket_custo_categoria.cd_categoria=ticket_venda_vista.cd_categoria')
            ->whereRaw('ticket_custo_categoria.dt_ini_vigencia=ticket_venda_vista.dt_ini_vigencia')
            ->whereRaw('ticket_custo_categoria.dt_ini_vigencia = ticket_venda_vista.dt_ini_vigencia')
            ->where('ticket_custo_categoria.cd_unidade', '=', $id)
            ->where('ticket_venda_vista.dt_venda', '>=', $data_ini)
            ->where('ticket_venda_vista.dt_venda', '<=', $data_fim)
            ->selectRaw('sum(ticket_custo_categoria.vl_categoria * ticket_venda_vista.qt_venda) as soma, ticket_venda_vista.dt_venda')
            ->groupBy('ticket_venda_vista.dt_venda')
            ->orderBy('ticket_venda_vista.dt_venda', 'DESC')
            ->get();

        return $soma;

    }

}
