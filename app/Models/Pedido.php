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

    const CANELADO = 0;  
    const AGUARDANDO_PAGAMENTO = 1;  
    const PROCESSANDO_PAGAMENTO = 2;  
    const PAGAMENTO_APROVADO = 3;  
    const EM_PRODUCAO = 4;  
    const PEDIDO_FINALIZADO = 5;  
    const PEDIDO_ENTREGUE = 6;

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

    public function podeEditar() {
        if(in_array($this->status,[self::AGUARDANDO_PAGAMENTO])) return true;
        else return false;
    }

    public function podePagar() {
        if(in_array($this->status,[self::AGUARDANDO_PAGAMENTO, self::PROCESSANDO_PAGAMENTO])) return true;
        else return false;
    }

    public function podeExcluir() {
        if ($this->podeEditar()) {
            return auth()->user()->tipo_usuario == 1;
        }
        return false;
    }
}
