@extends('layout.venda')

@section('venda')


    <!-- Form Name -->
    <legend>{{$categoria->cd_categoria}} - {{$categoria->ds_categoria}}</legend>

    <form class="form-horizontal"style="margin-top: 50px;">
        <fieldset>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Data Início Vigência</label>
                <div class="col-md-4">
                    <input id="campoData" name="textinput" placeholder="Data Início Vigência" class="form-control input-md"
                           type="text">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Custo</label>
                <div class="col-md-4">
                    <input id="currency" name="textinput" placeholder="Valor da categoria" class="form-control input-md"
                           type="text">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">

                <div class="col-md-4 col-lg-offset-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Enviar</button>
                </div>
            </div>
            <input type="hidden" name="cd_categoria" value="{{$categoria->cd_categoria}}">
            <input type="hidden" name="cd_unidade" value="{{$categoria->cd_unidade}}">

        </fieldset>
    </form>

    <script>
        jQuery(function ($) {
            $("#campoData").mask("99/99/9999");
        });
    </script>
@stop