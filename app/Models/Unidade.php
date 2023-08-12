<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = [          
        'grupo_id',       
        'razao_social',
        'nome_fantasia',
        'cnpj',                     
        'email',
        'telefone',
        'endereco',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'uf'
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }
}
