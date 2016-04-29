<?php
namespace Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket_Venda_Prazo extends Model{

    protected $table = 'ticket_venda_prazo';

    public $timestamps = false;

    protected $primaryKey = 'cd_unidade, cd_categoria, dt_ini_vigencia, matricula, lin_func,ano_mes_venda';

    protected $fillable = ['cd_unidade', 'cd_categoria', 'dt_ini_vigencia', 'dt_venda', 'qt_venda'];

    protected $casts = [
        'cd_unidade' => 'integer',
        'cd_categoria' => 'integer',
        'qt_venda' => 'integer',
    ];


}