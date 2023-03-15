<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoItens extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',        
        'produto_id',
        'tamanho_id',        
        'quantidade',
        'valor_unitario',
        'modalidade_id',
        'nome_personalizado',
        'numero_personalizado'        
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function tamanho(): BelongsTo
    {
        return $this->belongsTo(Tamanho::class);
    }

    public function modalidade(): BelongsTo
    {
        return $this->belongsTo(Modalidade::class);
    }
 
}
