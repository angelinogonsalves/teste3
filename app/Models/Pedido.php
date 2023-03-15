<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidade_id',
        'user_id',
        'ra_aluno',
        'nome_aluno',
        'status',
        'valor',
        'id_pagseguro',
        'cod_referencia',
        'total'
    ];


    public function itens(): HasMany
    {
        return $this->hasMany(PedidoItens::class);
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
