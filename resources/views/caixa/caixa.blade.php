@extends('layout.caixa')

@section('caixa')

    @if(Session::has('message'))
        <div class="alert alert-danger">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

    @if($msg == 'ok')

    <div class="row">
        <div class="col-md-8 col-lg-offset-2">

            <table class="table table-striped">
                <thead>

                <th class="text-center">Data de Atividade</th>
                <th class="text-center">Valor da Venda do Dia</th>
                <th class="text-center">Valor do Depósito</th>
                <th class="text-center">Valor do Troco</th>

                @foreach($caixa as $k=>$ca)
                    <tr data-toggle="collapse" data-target="#{{date('Y-m-d', strtotime($ca->dt_atividade))}}" class="acordion-toggle clickable">
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
                            {{'$'}}
                            {{money_format('%i' ,$ca->vl_deposito)}}
                        </td>
                        <td>
                            {{'$'}}
                            {{money_format('%i' , $ca->vl_troco)}}
                        </td>
                        @if(date('d/m/Y', strtotime($ca->dt_atividade)) == date('d/m/Y'))
                            <td>
                                {!! Form::open(array('url' => 'caixa/' . $ca->cd_unidade)) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                <button id="submit" name="submit" class="btn btn-danger glyphicon glyphicon-trash"></button>
                                <input type="hidden" name="dt_atividade" value="{{date('Y-m-d', strtotime($ca->dt_atividade))}}">
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div id="{{date('Y-m-d', strtotime($ca->dt_atividade))}}" class="collapse">
                                <div>
                                    {!! Form::model($restaurante, array('url' => 'caixa/'.$restaurante->cd_unidade.'/update', 'method' => 'put', 'class'=>'form-horizontal')) !!}

                                    {!! Form::label('vl_deposito', 'Depósito', ['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-4">
                                        <input id="currency" name="vl_deposito" type="vl_deposito" placeholder="Valor de depósito" value="{{ $ca->vl_deposito }}"
                                               class="form-control input-md">
                                    </div>
                                    <input type="hidden" name="dt_atividade" value="{{date('Y-m-d', strtotime($ca->dt_atividade))}}">
                                    {!! Form::submit('Alterar', ['class'=>'col-sm-2  btn btn-success']) !!}

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </thead>
            </table>
        </div>
    </div>
    @endif

    @if($msg == 'erro')
        <div class="alert alert-danger">
            <p>Selecione uma data válida.</p>
        </div>
    @endif

@stop
