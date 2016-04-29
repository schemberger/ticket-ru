@extends('layout.venda')

@section('venda')

<div class="row" style="margin-top: 50px">

    <div class="col-lg-offset-9">
        <a class="btn btn-default btn-primary btn-lg" href="{{ url('categoria/'.$restaurante->cd_unidade.'/create') }}" role="button">Nova Categoria</a>
    </div>

    <div class="col-lg-10 col-lg-offset-1" style="margin-top: 20px">
        <table class="table table-striped">
            <thead>

            <th class="text-center">Codigo</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Descrição da Categoria</th>
            <th class="text-center">Emitir Ticket</th>
            <th class="text-center">Debito em Conta?</th>
            <th class="text-center">Editar Custo</th>

            @foreach($tabela as $ta)
                    <tr>
                        <td>
                            {{$ta->cd_unidade}}
                        </td>
                        <td>
                            {{$ta->cd_categoria}}
                        </td>
                        <td class="text-left">
                            {{$ta->ds_categoria}}
                        </td>
                        <td>
                            {{$ta->cd_emitir_ticket}}
                        </td>
                        <td>
                            {{$ta->cd_debito}}
                        </td>
                        <td>
                            {!! Form::open(array('url' => 'categoria/'.$restaurante->cd_unidade.'/createCusto', 'class'=>'form-horizontal')) !!}

                                <input type="hidden" name="cd_categoria" value="{{$ta->cd_categoria}}">
                                <button id="submit" name="submit" class="btn btn-danger glyphicon glyphicon-edit"></button>

                            {!! Form::close() !!}
                        </td>
                    </tr>
            @endforeach
            </thead>
        </table>
    </div>
</div>

@stop