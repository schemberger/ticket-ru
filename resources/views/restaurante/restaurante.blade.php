@extends('layout.master')

@section('content')

    <div class="container-fluid">
        <div class="row-fluid centro">
            <div class="col-md-6 col-md-offset-3">
                @foreach($unidades as $un)
                    <a href="{{ url('caixa/'.$un->cd_unidade) }}" class="btn btn-primary btn-lg btn-block" role="button">{{$un->nm_unidade}}</a><br>
                @endforeach
            </div>
        </div>
    </div>
@stop
