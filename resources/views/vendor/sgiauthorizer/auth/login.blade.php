@extends(Config::get('sgiauthorizer.view.layout'))

@section(Config::get('sgiauthorizer.view.contentSection'))
<div class='container'>
    {!! Form::open(array('url' => Config::get('app.loginRoute'), 'class'=>'form-horizontal')) !!}
    <fieldset>
        <legend>Solicitação de suporte</legend>
        
        <div class="form-group">
            {!! Form::label('username', 'Usuário', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('username', null, ['placeholder'=>'digite seu nome de usuário', 'class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Senha', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::password('password', null, ['class'=>'form-control']) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::submit('Login', ['class'=>'col-sm-2 col-sm-offset-2 btn btn-default']) !!}
        </div>
    </fieldset>
</div>
@stop