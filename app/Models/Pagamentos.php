<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data_pagto',
        'valor_pagto'
    ];

    function assinates()
    {
        return $this->belongsTo(Assinaturas::class, 'cliente_id', 'id');
    }
}
