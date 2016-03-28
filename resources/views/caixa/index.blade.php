@extends('layout.caixa')

@section('caixa')

    @if(Session::has('message'))
        <div class="alert alert-danger">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-lg-offset-2">

            <table class="table table-striped">
                <thead>

                <th class="text-center">Data de Atividade</th>
                <th class="text-center">Valor da Venda do Dia</th>
                <th class="text-center">Valor do Depósito</th>
                <th class="text-center">Valor do Troco</th>
                <th></th>

                @foreach($caixa as $k=>$ca)
                    <tr>
                        <td>
                            {{date('d/m/Y', strtotime($ca->dt_atividade))}}
                        </td>
                        <td>
                            R$
                            @if(isset($venda_dia[$k]))
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

                        <td>
                            {!! Form::open(array('url' => 'caixa/' . $ca->cd_unidade)) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                                <button id="submit" name="submit" class="btn btn-danger glyphicon glyphicon-trash"></button>
                                <input type="hidden" name="dt_atividade" value="{{date('Y-m-d', strtotime($ca->dt_atividade))}}">
                            {!! Form::close() !!}
                        </td>

                    </tr>
                @endforeach


                </thead>
            </table>
        </div>
    </div>

@stop
