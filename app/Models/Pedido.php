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

    const CANCELADO = 0;  
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

    public function podeEditar() 
    {
        if (in_array($this->status,[self::AGUARDANDO_PAGAMENTO])) {
            return true;
        }
        return false;
    }

    public function podePagar() 
    {
        if (in_array($this->status,[self::AGUARDANDO_PAGAMENTO, self::PROCESSANDO_PAGAMENTO])) {
            return true;
        } 
        return false;
    }

    public function podeMudarStatus() 
    {
        if (in_array($this->status,[self::CANCELADO, self::PEDIDO_ENTREGUE])) {
            return false;
        } 
        return true;
    }

    public function podeExcluir() 
    {
        if ($this->podeEditar()) {
            return auth()->user()->tipo_usuario == 1;
        }
        return false;
    }

    public function nomeStatus(int $status = null)
    {
        $nomeStatus = [
            self::CANCELADO => 'Cancelado',
            self::AGUARDANDO_PAGAMENTO => 'Aguardando Pagamento',
            self::PROCESSANDO_PAGAMENTO => 'Processando Pagamento',
            self::PAGAMENTO_APROVADO => 'Pagamento Aprovado',
            self::EM_PRODUCAO => 'Em Produção',
            self::PEDIDO_FINALIZADO => 'Pedido Finalizado',
            self::PEDIDO_ENTREGUE => 'Pedido Entregue',
        ];

        if(is_null($status)) {
            return $nomeStatus[$this->status];
        }

        return $nomeStatus[$status];
    }

    public function classeStatus(int $status = null)
    {
        $classeStatus = [
            self::CANCELADO => 'white',
            self::AGUARDANDO_PAGAMENTO => 'danger',
            self::PROCESSANDO_PAGAMENTO => 'warning',
            self::PAGAMENTO_APROVADO => 'success',
            self::EM_PRODUCAO => 'dark',
            self::PEDIDO_FINALIZADO => 'info',
            self::PEDIDO_ENTREGUE => 'primary',
        ];

        if(is_null($status)) {
            return $classeStatus[$this->status];
        }

        return $classeStatus[$status];
    }

    public function novoStatus() 
    {
        if ($this->status == self::AGUARDANDO_PAGAMENTO || $this->status == self::PROCESSANDO_PAGAMENTO ) {
            return self::PAGAMENTO_APROVADO;
        }
        if ($this->status == self::PAGAMENTO_APROVADO) {
            return self::EM_PRODUCAO;
        }
        if ($this->status == self::EM_PRODUCAO) {
            return self::PEDIDO_FINALIZADO;
        }
        if ($this->status == self::PEDIDO_FINALIZADO) {
            return self::PEDIDO_ENTREGUE;
        }
        return $this->status;
    }


    public function novoNomeStatus() 
    {
        if ($this->status == self::AGUARDANDO_PAGAMENTO || $this->status == self::PROCESSANDO_PAGAMENTO ) {
            return $this->nomeStatus(self::PAGAMENTO_APROVADO);
        }
        if ($this->status == self::PAGAMENTO_APROVADO) {
            return $this->nomeStatus(self::EM_PRODUCAO);
        }
        if ($this->status == self::EM_PRODUCAO) {
            return $this->nomeStatus(self::PEDIDO_FINALIZADO);
        }
        if ($this->status == self::PEDIDO_FINALIZADO) {
            return $this->nomeStatus(self::PEDIDO_ENTREGUE);
        }
        return '';
    }

    public function novaClasseStatus() 
    {
        if ($this->status == self::AGUARDANDO_PAGAMENTO || $this->status == self::PROCESSANDO_PAGAMENTO ) {
            return $this->classeStatus(self::PAGAMENTO_APROVADO);
        }
        if ($this->status == self::PAGAMENTO_APROVADO) {
            return $this->classeStatus(self::EM_PRODUCAO);
        }
        if ($this->status == self::EM_PRODUCAO) {
            return $this->classeStatus(self::PEDIDO_FINALIZADO);
        }
        if ($this->status == self::PEDIDO_FINALIZADO) {
            return $this->classeStatus(self::PEDIDO_ENTREGUE);
        }
        return '';
    }

    public function dataFormatada($formato = 'd/m/Y') 
    {
        return date($formato, strtotime($this->created_at));
    }
}
