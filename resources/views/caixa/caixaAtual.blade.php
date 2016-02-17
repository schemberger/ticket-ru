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



                        </td>
                        <td>

                            {{'$'}}
                            {{money_format('%i' , $vl_troco->vl_troco)}}

                        </td>
                    </tr>

                </fieldset>

                {!! Form::close() !!}

                </thead>
            </table>
        </div>
    </div>



@stop