@extends('layout.master')

@section('content')

    <link href="{{ asset('/bootstrap/css/menu.css') }}" rel="stylesheet">

    <div class="topo">
        <h3>Ticket Refeição - {{$restaurante->nm_unidade}}</h3>
    </div>

    <div class="row-fluid">
        <div class="col-sm-3">
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">

                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul class="nav navbar-nav">

                            <li class="btn btn-default btn-primary btn-lg" role="button"><a
                                        href="{{ url('caixa/'.$restaurante->cd_unidade) }}">Caixa</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Perdas a Vista</a>
                            </li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Perdas a Prazo</a>
                            </li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Categorias</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a
                                        href="{{ url('restaurante') }}">Mudar Unidade</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a
                                        href="{{ url('restaurante/lista') }}">Unidades</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="{{ url('/venda/'.$restaurante->cd_unidade) }}">Venda</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Relatórios</a></li>

                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="col-sm-9">

            <div class="row ">
                <a href="{{ url('caixa/'.$restaurante->cd_unidade.'/create') }}" class="btn btn-primary btn-lg"
                   role="button">Abrir Caixa</a>
                <p></p>
            </div>

            {!! Form::open(array('url' => 'caixa/'.$restaurante->cd_unidade.'/show', 'class'=>'form-horizontal')) !!}

            <fieldset>
                <div class="row">
                    <div class="col-md-1 col-lg-offset-4">

                        {!! Form::select('mes', ['Mês', '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril', '05' => 'Maio', '06' => 'Junho',
                             '07' =>'Julho', '08' => 'Agosto', '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'],
                                ['class' => 'form-control']) !!}

                    </div>
                    <div class="col-md-1 col-md-offset-1">

                        {!! Form::select('ano', ['Ano', date("Y") => date("Y"), date("Y")-1 => date("Y")-1, date("Y")-2 => date("Y")-2, date("Y")-3 => date("Y")-3, date("Y")-4 => date("Y")-4]) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::submit('Buscar', ['class'=>'col-sm-1 btn btn-primary']) !!}
                    </div>

                </div>
            </fieldset>

            {!! Form::close() !!}

            @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @yield('caixa')

        </div>
    </div>

    <div class="clearfix"></div>

@stop