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

    public static function validaCategoria($cd_unidade, $cd_categoria){

        $valida = Ticket_Categoria::where('cd_unidade', '=', $cd_unidade)
            ->where('cd_categoria', '=', '$cd_categoria')
            ->get();
        if(count($valida)){
            return 0;
        }else{
            return $valida;
        }
    }

}