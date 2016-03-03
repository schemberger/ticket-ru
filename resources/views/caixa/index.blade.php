@extends('layout.caixa')

@section('caixa')

    <div class="row">
        <div class="col-md-8 col-lg-offset-2">

            <table class="table table-striped">
                <thead>

                <th class="text-center">Data de Atividade</th>
                <th class="text-center">Valor da Venda do Dia</th>
                <th class="text-center">Valor do Depósito</th>
                <th class="text-center">Valor do Troco</th>

                @foreach($caixa as $k=>$ca)
                    <tr>
                        <td>
                            {{date('d/m/Y', strtotime($ca->dt_atividade))}}
                        </td>
                        <td>
                            R$
                            @if(isset($venda_dia[$k])){}
                            {{money_format('%i' ,$venda_dia[$k]->soma)}}
                            @else
                                {{money_format('%i' ,0)}}
                            @endif
                        </td>
                        <td>
                            {{'R$'}}
                            {{money_format('%i' ,$ca->vl_deposito)}}
                        </td>
                        <td>
                            {{'R$'}}
                            {{money_format('%i' , $ca->vl_troco)}}
                        </td>
                    </tr>
                @endforeach

                </thead>
            </table>
        </div>
    </div>

@stop
