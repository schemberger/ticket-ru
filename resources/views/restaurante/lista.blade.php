@extends('layout.master')

@section('content')

    <h2>Unidades</h2>
    <a class="btn btn-success " href="{{ url('restaurante') }}" role="button">Voltar</a>
    <nav class="pull-right">
        <a class="btn btn-default btn-primary btn-lg" href="{{ url('restaurante/create') }}" role="button">Nova Unidade</a>
        <a class="btn btn-default btn-primary btn-lg" href="{{ url('restaurante/ajuda') }}" role="button">Ajuda</a>
    </nav>

    @if(Session::has('message'))
        <div class="alert alert-danger">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
    <div class="row">
        <table class="table table-striped">
            <thead>

            <th>Codigo</th>
            <th>Nome</th>
            <th>Número Sequência</th>

            @foreach($unidades as $un)
                <tr>
                    <td>
                        {{$un->cd_unidade}}
                    </td>
                    <td class ="link" onclick="location.href='{{ url('restaurante/'.$un->cd_unidade.'/edit') }}'">
                        {{$un->nm_unidade}}
                    </td>
                    <td>
                        {{$un->nr_sequencia}}
                    </td>
                </tr>
            @endforeach
            </thead>
        </table>
    </div>
@stop

