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

                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="{{ url('caixa/'.$restaurante->cd_unidade.'/caixa') }} ">Caixa</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Perdas a Vista</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Perdas a Prazo</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Categorias</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="{{ url('restaurante') }}">Mudar Unidade</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="{{ url('restaurante/lista') }}">Unidades</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Venda</a></li>
                            <li class="btn btn-default btn-primary btn-lg" role="button"><a href="#">Relatórios</a></li>

                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

    </div>

@stop