@extends('layout.venda')

@section('venda')



<div class="row">
    <div class="col-md-8 col-lg-offset-2">

        <div>
            {!! Form::open(array('url' => '#')) !!}
            {!! Form::hidden('_method', 'POST') !!}

                <label class="control-label col-md-2" for="submit" style="font-size: 20px">Código</label>
                <div class="col-md-2">
                    <input id="resultado" name="codigo" type="codigo" placeholder="Código" value=""
                           class="form-control input-md">
                </div>

                <label class="control-label col-md-2 col-lg-offset-3" for="submit" style="font-size: 20px">Quantidade</label>
                <div class="col-md-2 ">
                    <input name="quantidade" type="quantidade" placeholder="Qntd." value=""
                           class="form-control input-md">
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

        {!! Form::open(array('url' => 'venda/'. $restaurante->cd_unidade.'/busca')) !!}
        {!! Form::hidden('_method', 'POST') !!}

            <h2>Servidor para Debitar</h2>
                <label class="control-label col-md-1" for="submit" style="font-size: 20px">Nome</label>
                <div class="col-md-6">
                    <input name="nome" type="nome" placeholder="Nome do Servidor" value=""
                           class="form-control input-md">
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