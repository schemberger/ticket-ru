@extends('layout.venda')

@section('venda')

    <div class="row">
        <div class="col-lg-offset-1 centro2">
            <a href="{{ url('categoria/'.$restaurante->cd_unidade) }}" class="btn btn-primary btn-lg" role="button">Voltar</a>
        </div>
    </div>

    <div class="centro2">
        {!! Form::open(array('url' => 'categoria', 'class'=>'form-horizontal')) !!}

        <fieldset>

            <div class="form-group">
                {!! Form::label('ds_categoria', 'Descrição da Categoria', ['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('ds_categoria', null, ['placeholder'=>'Descreva a categoria', 'class'=>'form-control']) !!}
                </div>
                </br>

                {!! Form::submit('Enviar', ['class'=>'col-sm-1 col-sm-offset-2 btn btn-success']) !!}
            </div>
        </fieldset>

        {!! Form::close() !!}
    </div>
@stop