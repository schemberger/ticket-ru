@extends('layout.venda')

@section('venda')

    @if(Session::has('message'))
        <div class="alert alert-danger">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

        <div class="col-md-8 col-lg-offset-2" style="margin-top: 50px">

            <div>
                {!! Form::open(array('url' => 'vendaPrazo/'.$restaurante->cd_unidade, 'method' => 'post', 'class'=>'form-horizontal')) !!}
                <div class="form-group">
                    <label class="control-label col-md-2" for="submit" style="font-size: 20px">Servidor</label>
                    <div class="col-md-8">
                        <input id="nome" name="nm_pessoa" type="text" placeholder="Nome do Servidor"
                               class="form-control input-md">
                        <input name="matricula" type="hidden" value="" class="form-control input-md">
                    </div>

                </div>
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
                    <tr class ="link teste1">
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

            <table class="table table-striped">
                <thead>

                <th class="text-center">Nome do Servidor</th>


                @foreach($servidor as $se)
                    <tr class ="link teste2">
                        <td class="nome">{{$se->nm_pessoa}}</td>
                    </tr>
                @endforeach

                </thead>
            </table>
        </div>
<script language="javascript1.2" type="text/javascript">
  $('.teste1').click(function(){
      $('#resultado').val($(this).children('td.codigo').html());
  });
  $('.teste2').click(function(){
      $('#nome').val($(this).children('td.nome').html());
  });
</script>

@stop



