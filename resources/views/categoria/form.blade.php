@extends('layout.venda')

@section('venda')

    <div class="centro2">
        {!! Form::open(array('url' => 'categoria', 'class'=>'form-horizontal')) !!}

        <fieldset>
            <!-- Form Name -->
            <legend>Categoria</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Descrição da Categoria</label>
                <div class="col-md-4">
                    <input id="textinput" name="ds_categoria" placeholder="Descreva a categoria" class="form-control input-md" type="text">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Custo da Categoria</label>
                <div class="col-md-4">
                    <input id="currency" name="vl_categoria" placeholder="Custo da Categoria" class="form-control input-md" type="text">
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

            <!-- Button -->
            <div class="form-group">

                <div class="col-md-4 col-lg-offset-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Enviar</button>
                </div>
            </div>

            <input type="hidden" name="cd_unidade" value="{{$restaurante->cd_unidade}}">
        </fieldset>

        {!! Form::close() !!}
    </div>
@stop