<?php
namespace Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket_Custo_Categoria extends Model{

    protected $table = 'ticket_custo_categoria';

    public $timestamps = false;

    protected $primaryKey = 'cd_unidade, cd_categoria, dt_ini_vigencia';

    protected $fillable = ['cd_unidade', 'cd_categoria', 'dt_ini_vigencia', 'dt_fim_vigencia', 'vl_categoria'];

    protected $casts = [
        'cd_unidade' => 'integer',
        'cd_categoria' => 'integer',
        'vl_categoria' => 'float',
    ];

}