@extends('layout.venda')

@section('venda')

    @if(Session::has('message'))
        <div class="alert alert-danger">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

<div class="row">
    <div class="col-md-8 col-lg-offset-2" style="margin-top: 50px">

        <div>
            {!! Form::model($restaurante, array('url' => 'venda/'.$restaurante->cd_unidade.'/update', 'method' => 'put', 'class'=>'form-horizontal')) !!}
            <div class="form-group">
                <label class="control-label col-md-2" for="submit" style="font-size: 20px">Código</label>
                <div class="col-md-2">
                    <input id="resultado" name="cd_categoria" type="text" placeholder="Código"
                           class="form-control input-md">
                </div>

                <label class="control-label col-md-2 col-md-offset-2" for="submit" style="font-size: 20px">Quantidade</label>
                <div class="col-md-2 ">
                    <input id ="quantidade" name="quantidade" type="text" placeholder="Qntd." value=""
                           class="form-control input-md">
                </div>
                <div class="col-md-2 pull-right">
                    {!! Form::submit('Imprimir', ['class'=>'btn-lg btn-success']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <table class="table table-striped">
            <thead>

            <th class="text-center">Código</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Valor</th>

            @foreach($tabela as $ta)
                <tr class ="link">
                    <td class="codigo">{{$ta->cd_categoria}}</td>
                    <td class="text-left">
                        {{$ta->ds_categoria}}
                    </td>
                    <td>
                        R$ {{money_format('%i', $ta->vl_categoria)}}
                    </td>
                </tr>
            @endforeach

            </thead>
        </table>

        {!! Form::open(array('url' => 'venda/'.$restaurante->cd_unidade.'/busca')) !!}
        {!! Form::hidden('_method', 'POST') !!}
        <div style="margin-top: 50px">

            <h2>Servidor para Debitar</h2>
                <label class="control-label col-md-1" for="submit" style="font-size: 20px">Nome</label>
                <div class="col-md-6">
                    <input name="nome" type="nome" placeholder="Nome do Servidor" value=""
                           class="form-control input-md">
                </div>
        </div>
        {!! Form::submit('Buscar', ['class'=>'btn btn-info']) !!}

        {!! Form::close() !!}

    </div>
</div>

<script language="javascript1.2" type="text/javascript">
    $('.link').click(function(){
        $('#resultado').val($(this).children('td.codigo').html());
    });
</script>

@stop