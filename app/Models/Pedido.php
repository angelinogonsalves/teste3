<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidade_id',
        'user_id',
        'nome_aluno',
        'status',
        'valor',
        'id_pagseguro',
        'total'
    ];


    public function itens(): HasMany
    {
        return $this->hasMany(PedidoItens::class);
    }
}
