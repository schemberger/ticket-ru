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

                {!! Form::open(array('url' => 'caixa', 'class'=>'form-horizontal')) !!}

                <fieldset>

                <tr>
                        <td>
                            {{date('d/m/Y')}}
                        </td>
                        <td>
                            $ 0
                        </td>
                        <td>

                            <input id="currency" name="vl_deposito" type="vl_deposito" placeholder="Valor de depósito" value="{{ old('vl_deposito') }}"
                                           class="form-control input-md">
                            <!-- {!! Form::text('vl_deposito', Input::old('vl_deposito')) !!} -->
                        </td>
                        <td>
                            <label class="control-label" for="vl_troco">{{money_format('%i' , $vl_troco->vl_troco)}} </label>
                            <input type="hidden" name="vl_troco" value="{{money_format('%i' , $vl_troco->vl_troco)}}">
                        </td>
                    <td>
                        <!-- Button (Double) -->
                        <div class="form-group">
                            <label class="control-label" for="submit"></label>
                            <div class="pull-right">
                                <button id="submit" name="submit" class="btn btn-success glyphicon glyphicon-ok"></button>

                            </div>
                        </div>
                    </td>

                </tr>

                </fieldset>
                <input type="hidden" name="cd_unidade" value="{{$restaurante->cd_unidade}}">

                {!! Form::close() !!}

                </thead>
            </table>
        </div>
    </div>



@stop