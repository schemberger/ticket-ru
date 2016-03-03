<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Ticket RU</title>

    <link href="{{ asset('/bootstrap/css/sticky-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/css/table.css') }}" rel="stylesheet">

    <script src="{{ asset('/bootstrap/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>

</head>
<body>


<div class="navbar navbar-default" role="navigation">

    <div class="navbar-header pull-left">

        <a class="navbar-brand" href="http://uepg.br/">
            <img src="{{ asset ('imagens/UEPG-Ticket.png')}}" alt="UEPG - Universidade Estadual de Ponta Grossa"
                 class="img-responsive" style="margin-top: -4px;">
        </a>

    </div>

    <div class="navbar-header navbar-right" style="padding: 0 15px;">



        <p class="navbar-text pull-left"><i class="glyphicon glyphicon-user"></i> <u>

                @section(Config::get('sgiauthorizer.view.contentLoggedUser'))
                    @if(session()->has('sgiauthorizer.usuario'))

                        <a href="<?php echo url(Config::get('sgiauthorizer.app.userInfoRoute'));?>">{{unserialize(session()->get('sgiauthorizer.usuario'))->username}}</a>

                        <a href="{{ url('') }}" class="" role="button">Sair</a>
                    @else
                        <a href="<?php echo url(Config::get('sgiauthorizer.app.loginRoute'));?>"
                           class="btn btn-default active" role="button"> Login </a>
                    @endif
                @show

            </u></p>

    </div>

</div>

@yield(Config::get('sgiauthorizer.view.contentSection'))

@yield(Config::get('sgiauthorizer.view.contentUserInfo'))

@yield('content')

<footer class="_footer navbar navbar-default pull-left pull-down">
    <div class="container-fluid">
        <p class="navbar-text">© {{date("Y")}} - <a href="http://pitangui.uepg.br/nti" target="_blank">Núcleo de Tecnologia de
                Informação - UEPG</a>
            </br>Problemas na visualização? <a href="mailto: internet@uepg.br" target="_blank">internet@uepg.br</a></p>

        <div class="navbar-header navbar-right hidden-xs">
            <a class="navbar-brand" href="http://pitangui.uepg.br/nti" target="_blank">
                <img src="https://sistemas.uepg.br/producao/abertura/imagens/NTI-48x48.png"
                     alt="NTI - Núcleo de Tecnologia de Informação" class="img-responsive" style="margin-top: -4px;">
            </a>
        </div>
    </div>
</footer>

</body>
</html>