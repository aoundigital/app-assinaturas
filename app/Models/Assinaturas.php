<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinaturas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'empresa',
        'sites',
        'email',
        'tipo',
        'data_inicio',
        'valor',
        'tipo_pagto',
        'del'
    ];

    // 'foreign_key', 'local_key'
    public function pagamentos()
    {
        return $this->hasMany(Pagamentos::class, 'cliente_id', 'id');
    }

    public function entregas()
    {
        return $this->hasMany(Entregas::class, 'cliente_id', 'id')->orderBy('data_entrega', 'DESC');
    }

    public function ativo()
    {
        return $this->hasOne(Ativo::class, 'cliente_id', 'id');
    }
}
