@extends('layout.master')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>Nome da unidade deve conter no mínimo 3 e no máximo 60 letras</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-offset-1 centro2">
            <a href="{{ url('restaurante/lista') }}" class="btn btn-primary btn-lg" role="button">Voltar</a>

            <a href="{{ url('restaurante/'.$restaurante->cd_unidade.'/excluir') }}" class="btn btn-danger btn-lg"
               role="button">Excluir Unidade</a>
        </div>
    </div>

    <div class="centro2">
        {!! Form::model($restaurante, array('url' => 'restaurante/'.$restaurante->cd_unidade, 'method' => 'put', 'class'=>'form-horizontal')) !!}

        <fieldset>

            <div class="form-group">
                {!! Form::label('nm_unidade', 'Nome', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nm_unidade', null, ['placeholder'=>'Digite o nome do Restaurante', 'class'=>'form-control']) !!}
                </div>
            </div>

            <br/>

            <div class="form-group">
                {!! Form::submit('Enviar', ['class'=>'col-sm-2 col-sm-offset-2 btn btn-default']) !!}
            </div>
        </fieldset>

        {!! Form::close() !!}

    </div>


@stop