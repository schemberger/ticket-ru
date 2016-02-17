<?php
namespace Ticket;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model{

    protected $table = 'ticket_caixa';

    public $timestamps = false;

    protected $primaryKey = 'cd_unidade';

    protected $fillable = ['cd_unidade', 'dt_atividade', 'vl_deposito', 'vl_troco'];

    protected $casts = [
        'cd_unidade' => 'integer',
        'vl_deposito' => 'float',
        'vl_troco' => 'float',
    ];

}