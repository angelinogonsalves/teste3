<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [          
        'codigo',
        'produto',
        'descricao',                     
        'valor',       
        'imagem1',      
        'imagem2',      
        'imagem3',       
        'imagem_medida',
        'personaliza_numero',
        'personaliza_nome',
        'personaliza_modalidade'        
    ];

    public function produtoTamanhos(): HasMany
    {
        return $this->hasMany(ProdutosTamanhos::class);
    }

    public function tamanhos(): BelongsToMany
    {
        return $this->belongsToMany(Tamanho::class,'produtos_tamanhos');
    }

    public function unidades(): BelongsToMany
    {
        return $this->belongsToMany(Unidade::class,'produtos_unidades');
    }
}
