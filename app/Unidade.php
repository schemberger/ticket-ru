<?php
namespace Ticket;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model{

    protected $table = 'unidade';

    public $timestamps = false;

    protected $primaryKey = 'cd_unidade';

    protected $fillable = ['cd_unidade', 'nm_unidade', 'nr_sequencia'];

    protected $casts = [
        'cd_unidade' => 'integer',
        'nr_sequencia' => 'integer',
    ];

}