<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'ativo'
    ];

    function assinates()
    {
        return $this->belongsTo(Assinaturas::class, 'cliente_id', 'id');
    }
}
