<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutosTamanhos extends Model
{
    use HasFactory;
    
    protected $fillable = [          
        'produto_id',
        'tamanho_id'
    ]; 
    
    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function tamanho(): BelongsTo
    {
        return $this->belongsTo(Tamanho::class);
    }
}
