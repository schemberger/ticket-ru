@extends('layout.venda')

@section('venda')

    <div class="container-fluid" style="margin-top: 50px">
        <div class="col-md-8 col-lg-offset-2">
            <table class="table table-striped">
                <thead>

                <th class="text-center">Matrícula</th>
                <th class="text-center">Nome do Servidor</th>
                <th class="text-center">RG</th>
                <th class="text-center">Linha Funcional</th>

                {!! Form::open(array('url' => 'vendaPrazo/' . $restaurante->cd_unidade)) !!}
                {!! Form::hidden('_method', 'POST') !!}

                    @foreach($servidor as $se)
                            <tr class ="link form-group" id="submit" name="submit">
                                <td>{{$se->matricula}}</td>
                                <td>{{$se->nm_pessoa}}</td>
                                <td>{{$se->nr_rg}}</td>
                                <td>{{$se->lin_func}}</td>

                                <input id="lin_func" name="lin_func" type="hidden"value="{{$se->lin_func}}"
                                       class="form-control input-md">
                                <input id="matricula" name="matricula" type="hidden"value="{{$se->matricula}}"
                                       class="form-control input-md">
                            </tr>
                    @endforeach
                {!! Form::close() !!}
                </thead>
            </table>
        </div>
    </div>

@stop
