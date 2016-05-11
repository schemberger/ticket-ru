@extends('layout.venda')

@section('venda')

    {!! Form::model($categoria, array('url' => 'categoria/'.$restaurante->cd_unidade, 'method' => 'put', 'class'=>'form-horizontal')) !!}

        <!-- Form Name -->
        <legend>Editar Categoria</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Descrição da Categoria</label>
            <div class="col-md-4">
                <input id="textinput" name="ds_categoria" value="{{$categoria->ds_categoria}}" class="form-control input-md" type="text">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="selectbasic">Emitir Ticket</label>
            <div class="col-md-4">
                <select id="selectbasic" name="cd_emitir_ticket" class="form-control">
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="selectbasic">Débito em Conta</label>
            <div class="col-md-4">
                <select id="selectbasic" name="cd_debito" class="form-control">
                    <option value="S">Sim</option>
                    <option value="N" selected="selected">Não</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="cd_categoria" value="{{$categoria->cd_categoria}}">

        <!-- Button -->
        <div class="form-group">
            <div class="col-md-8 col-lg-offset-4">
                {!! Form::open(array('url' => 'categoria/'. $categoria->cd_unidade)) !!}
                {!! Form::hidden('_method', 'DELETE') !!}

                    <button id="singlebutton" name="singlebutton" class="btn btn-danger">Excluir Categoria</button>
                    <input type="hidden" name="cd_categoria" value="{{$categoria->cd_categoria}}">

                {!! Form::close() !!}
                <button id="singlebutton" name="singlebutton" class="btn btn-success col-lg-offset-2">Enviar</button>
            </div>
        </div>

    {!! Form::close() !!}





@stop