@extends('layout.venda')

@section('venda')

    @if(Session::has('message'))
        <div class="alert alert-danger">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

    @if(session::has('data'))
        <body onLoad="$('#my-modal').modal('show');">
        <div id="my-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Venda Ticket</h4>
                    </div>
                    <div class="modal-body">
                        Valor Total do Tickets: R$ {{ Session::get('data') }}0
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
    @endif

    <div class="row">
        <div class="col-md-8 col-lg-offset-2" style="margin-top: 50px">

            <div>
                {!! Form::model($restaurante, array('url' => 'venda/'.$restaurante->cd_unidade.'/vendaVista', 'method' => 'put', 'class'=>'form-horizontal')) !!}
                <div class="form-group">
                    <label class="control-label col-md-2" for="submit" style="font-size: 20px">Código</label>
                    <div class="col-md-2">
                        <input id="resultado" name="cd_categoria" type="text" placeholder="Código"
                               class="form-control input-md">
                    </div>

                    <label class="control-label col-md-2 col-md-offset-2" for="submit" style="font-size: 20px">Quantidade</label>
                    <div class="col-md-2 ">
                        <input id="quantidade" name="quantidade" type="text" placeholder="Qntd." value=""
                               class="form-control input-md">
                    </div>
                    <div class="col-md-2 pull-right">
                        {!! Form::submit('Imprimir', ['class'=>'btn-lg btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

                <table class="table table-striped">
                    <thead>

                    <th class="text-center">Código</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Valor</th>

                    @foreach($tabela as $ta)
                        <tr class="link">
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
                <div class="form-group" style="margin-top: 50px">

                    <h2>Servidor para Debitar</h2>
                    <label class="control-label col-md-1" for="submit" style="font-size: 20px">Nome</label>
                    <div class="col-md-6">
                        <input name="nome" type="nome" placeholder="Nome do Servidor" value=""
                               class="form-control input-md">
                    </div>
                    {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
                    <div class="pull-right">
                        <label class="control-label" style="font-size: 18px">Ano/Mês Débito:</label>
                        <button type="text" class="btn btn-default" disabled
                                style="font-size: 18px; opacity: 1">{{$mes}}</button>
                    </div>


                </div>
                {!! Form::close() !!}

            </div>
        </div>

        <script language="javascript1.2" type="text/javascript">
            $('.link').click(function () {
                $('#resultado').val($(this).children('td.codigo').html());
            });
        </script>


@stop