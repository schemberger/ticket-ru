<?php

namespace Ticket\Http\Controllers;

use Illuminate\Http\Request;

use Monolog\Handler\NullHandlerTest;
use Ticket\Caixa;
use Ticket\Http\Requests;
use Ticket\Http\Controllers\Controller;
use DB;
use Ticket\Http\Controllers\CaixaController;
use Ticket\Ticket_Categoria;
use Ticket\Ticket_Custo_Categoria;
use Ticket\Ticket_Venda_Vista;
use Ticket\Ticket_Venda_Prazo;
use Ticket\Unidade;
use Illuminate\Support\Facades\Validator;


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

        $mes_debito = $this->mesDebito();

        if(count($caixa_dia)){

            return view('venda.venda',['restaurante' => \Ticket\Unidade::find($id), 'tabela' => $tabela, 'mes'=>$mes_debito]);

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
        $this->validate($request, [
            'cd_categoria' => 'required',
            'quantidade' => 'required|min:1',
        ]);

        if(Ticket_Categoria::validaCategoria($id, $request->cd_categoria)){

            return back()-> with('message', 'Categoria não encontrada.');

        }else{

            $unidade = Unidade::find($id);
            $unidade->nr_sequencia += $request->quantidade;
            $unidade->save();
            return redirect('venda/'.$unidade->cd_unidade);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return mixed
     * A função recebe como parametro o $id da unidade e faz um select para montar a tabela com o valor de cada
     * categoria, seu código e sua categoria.
     * ex: categoria: integral-servidores e professores, código: 1, valor: 1.90
     */
    public function categoria($id){

        $tabela = \Ticket\Ticket_Custo_Categoria::join('ticket_categoria', 'ticket_custo_categoria.cd_unidade', '=', 'ticket_categoria.cd_unidade')
            ->whereRaw('ticket_custo_categoria.cd_categoria = ticket_categoria.cd_categoria')
            ->where('ticket_categoria.cd_unidade', '=', $id)
            ->where('dt_fim_vigencia', '=', null)
            ->orderBy('ticket_categoria.cd_categoria')
            ->get();

        return $tabela;
    }

    public function buscaServidor(Request $request, $id)
    {
        $tabela = $this->categoria($id);

        $consulta = DB::select('EXEC Pessoas ?', array($request->nome));

        $mes_debito = $this->mesDebito();

        if(empty($consulta)){

            return redirect ('venda/'.$id)->with('message', 'Servidor não encontrado');

        }else{
            return view('venda.venda_prazo',['restaurante' => \Ticket\Unidade::find($id),'servidor' => $consulta,'tabela' => $tabela, 'mes'=>$mes_debito]);

        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * A função é responsável por tratar uma venda a vista, valida os campos categoria e quantidade da view, atribui a
     * variável $categoria um select pois necessita do campo cd_categoria da tabela Ticket_Custo_Categoria para fazer
     * a validação se existe ou não a categoria enviada pelo usuário.
     * Autenticada a categoria, temos outro if que verifica se possui alguma venda no dia atual naquela
     * categoria específica, caso tenha venda ele
     * apenas atualiza o campo qt_vendas passando a quantidade enviada pelo usuário.
     * Caso seja a primeira venda daquela categoria, criamos um novo registro.
     * Ainda dentro do primeiro if, atualizamos o valor do troco chamando a função valorVenda, e depois atualiza o valor
     * do número de sequencia da tabela unidade.
     */
    public function vendaVista(Request $request, $id)
    {

        $this->validate($request, [
            'cd_categoria' => 'required',
            'quantidade' => 'required|min:1',
        ]);

        //Faz uma busca com a categoria recebida por request e testa se a categoria existe ou não
        if(Ticket_Categoria::validaCategoria($id, $request->cd_categoria)){

            return back()-> with('message', 'Categoria não encontrada.');

        }else{
            $categoria = Ticket_Custo_Categoria::where('cd_unidade', '=', $id)
                ->where('cd_categoria', '=', $request->cd_categoria)
                ->first();

            $aux = Ticket_Venda_Vista::where('cd_unidade', '=', $id)
                ->where('cd_categoria', '=', $request->cd_categoria)
                ->where('dt_ini_vigencia', '=', $categoria->dt_ini_vigencia)
                ->where('dt_venda', '=', date('Y-m-d'))
                ->first();

            //Verificação caso não seja a primeira venda, apenas fazer um update na tabela.
            if(count($aux)){

                Ticket_Venda_Vista::where('cd_unidade', '=', $id)
                    ->where('cd_categoria', '=', $request->cd_categoria)
                    ->where('dt_ini_vigencia', '=', $categoria->dt_ini_vigencia)
                    ->where('dt_venda', '=', date('Y-m-d'))
                    ->update(array('qt_venda' => $aux->qt_venda + $request->quantidade));

            }
            //Verificação caso seja a primeira venda do dia, então deve se criar um novo campo na tabela.
            else{

                $venda = new Ticket_Venda_Vista();
                $venda->cd_unidade = $id;
                $venda->cd_categoria = $request->cd_categoria;
                $venda->dt_ini_vigencia = $categoria->dt_ini_vigencia;
                $venda->dt_venda = date('Y-m-d');
                $venda->qt_venda = $request->quantidade;
                $venda->save();

            }

            $aux =Caixa::where('cd_unidade', '=', $id)
                ->where('dt_atividade', '=', date('Y-m-d'))
                ->get()->first();

            $valorVenda = $this->valorVenda($id, $request->cd_categoria, $request->quantidade);

            Caixa::where('cd_unidade', '=', $id)
                ->where('dt_atividade', '=', date('Y-m-d'))
                ->update(array('vl_troco' => $aux->vl_troco + $valorVenda));

            $unidade = Unidade::find($id);
            $unidade->nr_sequencia += $request->quantidade;
            $unidade->save();

            //return view('venda/'.$unidade->cd_unidade,['vl_venda' => $venda]);

            return redirect('venda/'.$unidade->cd_unidade)->with('data', $valorVenda);
        }
    }

    public function vendaPrazo(Request $request, $id){

        $this->validate($request, [
            'cd_categoria' => 'required',
            'quantidade' => 'required|min:1',
        ]);

        $consulta = DB::select('EXEC Pessoas ?', array($request->nm_pessoa));

        /** $data chama a função mesDebito() e recebe como valor uma data no formato mm/aaaa, para fazer insert ou update
         * no banco o formato usado é aaaamm, EX:201601 por isso a função explode é usada para retirar a '/' e formatado
         * para fazer operações no banco.
        */
        $data = explode('/', $this->mesDebito(), 2);

        if(DB::table('DIFI..bloqueado')->where('matricula', '=', $consulta[0]->matricula)->get()){

            return redirect('venda/'.$id)->with('message', 'Servidor Bloqueado para débito! Entre em contato com a DIFI-Receita!.');

        }else {
            if (Ticket_Categoria::validaCategoria($id, $request->cd_categoria)) {

                return redirect('venda/'.$id)->with('message', 'Categoria não encontrada.');

            } else {

                $categoria = Ticket_Custo_Categoria::where('cd_unidade', '=', $id)
                    ->where('cd_categoria', '=', $request->cd_categoria)
                    ->first();

                $aux = Ticket_Venda_Prazo::where('cd_unidade', '=', $id)
                    ->where('cd_categoria', '=', $request->cd_categoria)
                    ->where('dt_ini_vigencia', '=', $categoria->dt_ini_vigencia)
                    ->where('matricula', '=', $consulta[0]->matricula)
                    ->where('dt_venda', '=', date('Y-m-d'))
                    ->first();

                //Verificação caso não seja a primeira venda, apenas fazer um update na tabela.
                if (count($aux)) {

                    Ticket_Venda_Prazo::where('cd_unidade', '=', $id)
                        ->where('cd_categoria', '=', $request->cd_categoria)
                        ->where('dt_ini_vigencia', '=', $categoria->dt_ini_vigencia)
                        ->where('matricula', '=', $consulta[0]->matricula)
                        ->where('lin_func', '=', $consulta[0]->lin_func)
                        ->where('ano_mes_venda', '=', $data[1].$data[0])
                        ->update(array('qt_venda' => $aux->qt_venda + $request->quantidade));

                } //Verificação caso seja a primeira venda do dia, então deve se criar um novo campo na tabela.
                else {

                    $venda = new Ticket_Venda_Prazo;
                    $venda->cd_unidade = $id;
                    $venda->cd_categoria = $request->cd_categoria;
                    $venda->dt_ini_vigencia = $categoria->dt_ini_vigencia;
                    $venda->matricula = $consulta[0]->matricula;
                    $venda->lin_func = $consulta[0]->lin_func;
                    $venda->ano_mes_venda = $data[1].$data[0];
                    $venda->marca = 'N';
                    $venda->qt_venda = $request->quantidade;
                    $venda->dt_venda = date('Y-m-d');
                    $venda->save();

                }
            }

            $mensagem = 'Recebida Universidade Estadual de Ponta Grossa '.$request->quantidade.' Tickets refeição ao valor de '.$categoria->vl_categoria
                .'0 cada e autorizo o débito do total em minha conta corrente junto ao pagamento de '.$this->mesDebito();

            $unidade = Unidade::find($id);
            $unidade->nr_sequencia += $request->quantidade;
            $unidade->save();
            return redirect('venda/'.$unidade->cd_unidade);
        }
    }

    /**
     * @param $id
     * @param $categoria
     * @param $quantidade
     * @return função retorna o valor da venda para poder atualizar o valor do troco no momento de cada venda
     */

    public function valorVenda($id, $categoria, $quantidade){

        $valor = Ticket_Custo_Categoria::where('cd_unidade', '=', $id)
            ->where('cd_categoria', '=', $categoria)
            ->first();

        $valorVenda = $valor->vl_categoria * $quantidade;

        return $valorVenda;
    }

    public function mesDebito(){

        $dia_hoje = date('d');
        $mes_hoje = date('m');

        if ($dia_hoje <= 15){
            $data = date('m/Y');
            return $data;
        }else{
            if($mes_hoje == 12){
                $data = '01/'.(date('Y')+1);
                return $data;
            }else{
                $data = date('m/Y', strtotime('+1 month'));
                return $data;
            }
        }
    }
}
