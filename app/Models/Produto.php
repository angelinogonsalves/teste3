<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'imagem_medida'       
           
    ];

    public function tamanhos(): HasMany
    {
        return $this->hasMany(ProdutosTamanhos::class);
    }

    public function unidades(): HasMany
    {
        return $this->hasMany(ProdutosUnidades::class);
    }
}
