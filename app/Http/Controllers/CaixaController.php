<?php

namespace Ticket\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;
use Illuminate\Http\Request;
use Ticket\Http\Requests;
use Ticket\Http\Controllers\Controller;
use Ticket\Ticket_Venda_Vista;
use Ticket\Caixa;
use Illuminate\Foundation\Validation\ValidatesRequests;

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
    public function create($id)
    {
        $caixas = \Ticket\Caixa::where('dt_atividade', '=', date('Y-m-d'))
            ->where('cd_unidade', '=', $id)->get();

        if(count($caixas)){

            return redirect('caixa/'.$id)->with('message', 'Caixa do dia já aberto.');;

        }else{

            $vl_troco = $this->valorTroco($id);

            return view('caixa.caixaCreate',['restaurante' => \Ticket\Unidade::find($id)],  compact('vl_troco'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vl_deposito' => 'numeric|min:0',
        ]);

        $vl_venda = $this->tabelaCaixa($request->cd_unidade, date('Y-m-d'), date('Y-m-d'));
        $troco_atual = $request->vl_troco + $vl_venda - $request->vl_deposito;

        $caixa = new Caixa;
        $caixa->cd_unidade = $request->cd_unidade;
        $caixa->vl_deposito = $request->vl_deposito;
        $caixa->dt_atividade = date('Y-m-d');
        $caixa->vl_troco = $troco_atual;
        $id = $caixa->cd_unidade;
        $caixa->save();

        return redirect('caixa/'.$id);
    }

    /**
     * @param $id
     * @return vl_troco
     * A função retorna o valor do troco do dia anterior para ser usado quando o caixa é aberto
     */
    public function valorTroco($id){
        $vl_troco = \Ticket\Caixa::select('vl_troco')
            ->orderBy('ticket_caixa.dt_atividade', 'desc')
            ->where('ticket_caixa.cd_unidade', '=', $id)
            ->take(1)->get()->first();
        return $vl_troco;
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
        $this->validate($request, [
            'valor' => 'numeric|min:0',
        ]);

        $troco = $request->vl_troco +($request->vl_deposito-$request->valor);

        Caixa::where('cd_unidade', '=', $id)
            ->where('dt_atividade', '=', $request->dt_atividade)
            ->update(array('vl_deposito' => $request->valor, 'vl_troco' => $troco));

        return redirect('caixa/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $vendaDia = $this->tabelaCaixa($id, $request->dt_atividade, $request->dt_atividade);

        if($vendaDia){

            return redirect('caixa/'.$id)->with('message', 'O caixa não pode ser apagado, pois possui vendas registradas.');

        }else{

            Caixa::where('ticket_caixa.dt_atividade', '=', $request->dt_atividade)
                ->where('ticket_caixa.cd_unidade', '=', $id)->delete();

            return redirect('caixa/'.$id);
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

        if(count($soma)){
            return $soma;
        }else
            return $soma=0;;
    }

}
