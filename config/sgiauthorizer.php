<?php
/**
 * Created by IntelliJ IDEA.
 * User: joaoh
 * Date: 11/13/15
 * Time: 9:45 AM
 */

return array(

    /*
    |-------------------------------------------
    | Client Array
    |-------------------------------------------
    |
    | id: ID do client,
    | secret: Senha do client
    |
    */

    'client' => [
        'id' => '1',
        'secret' => 'ticket-ru123Alex',
    ],

    /*
    |-------------------------------------------
    | Server Array
    |-------------------------------------------
    |
    | host: Ip do servidor da aplicação,
    | path: Caminho base da aplicação
    |
    */

    'server' => [
        'host' => 'http://dev01.redes.uepg.br/',
        'path' => 'sgi-security-server/server/public/'
    ],

    /*
   |-------------------------------------------
   | App Array
   |-------------------------------------------
   |
   | loginRoute: Rota de login da aplicação.
   |
   | userInfoRoute: Rota para exibir informações do usuario logado.
   |
   */

    'app' => [
        'loginRoute' => '/login',
        'userInfoRoute' => '/user/profile'
    ],
  
    /*
   |-------------------------------------------
   | View Array
   |-------------------------------------------
   |
   | layout: Nome da visão utilizada como layout na aplicação, será extendida pela 
   |             visão do formulário disponibilizado com este pacote.
   |
   | contentSection: Nome da seção no layout principal onde deve ser inserido o formulário
   |                de login.
   |
   | loginView: Nome da View (formato Blade) de login da aplicação. O padrão utiliza a view disponibilizada
   |                por este pacote, ela pode ser alterada por uma view especifica de sua aplicação.
   |
   | contentLoggedUser: Nome da seção no layout principal onde deve ser inserido o username
   |                do usuario logado.
   |
   | contentUserInfo: Nome da seção no layout principal onde deve ser inserido os dados do usuario logado.
   |
   */

    'view' => [
        'layout' => 'layout.master',
        'contentSection' => 'loginContent',
        'loginView' => 'sgiauthorizer::auth.login',
        'userInfoView' => 'sgiauthorizer::auth.showUserInfo',
        'loggedUserView' => 'sgiauthorizer::auth.loggedUser',
        'contentLoggedUser' => 'userContent',
        'contentUserInfo' => 'userinfo'
    ]

);