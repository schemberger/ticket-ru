<?php
namespace Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket_Venda_Vista extends Model{

    protected $table = 'ticket_venda_vista';

    public $timestamps = false;

    protected $primaryKey = 'cd_unidade, cd_categoria, dt_ini_vigencia, dt_venda';

    protected $fillable = ['cd_unidade', 'cd_categoria', 'dt_ini_vigencia', 'dt_venda', 'qt_venda'];

    protected $casts = [
        'cd_unidade' => 'integer',
        'cd_categoria' => 'integer',
        'qt_venda' => 'integer',
    ];


}