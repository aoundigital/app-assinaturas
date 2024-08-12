<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data_entrega',
        'quantidade',
        'qualidade',
        'tipo',
		'descricao'
    ];

    function assinates()
    {
        return $this->belongsTo(Assinaturas::class, 'cliente_id', 'id');

        // ->withDefault([
        //     'cliente_id' => 0,
        //     'data_entrega' => '2021-01-01',
        //     'quantidade' => 0,
        //     'qualidade' => 'C',
        //     'tipo' => 'nofollow',
        // ]);
    }
}
