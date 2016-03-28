<?php
namespace Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket_Categoria extends Model{

    protected $table = 'ticket_categoria';

    public $timestamps = false;

    protected $primaryKey = 'cd_unidade, cd_categoria, ds_categoria';

    protected $fillable = ['cd_unidade', 'cd_categoria', 'ds_categoria', 'cd_emitir_ticket', 'cd_debito'];

    protected $casts = [
        'cd_unidade' => 'integer',
        'cd_categoria' => 'integer',
    ];

}