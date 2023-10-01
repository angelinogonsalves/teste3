<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('datetime', function (string $expression) {
            return "<?php echo date('d/m/Y H:i', strtotime($expression)); ?>";
        });

        Blade::directive('date', function (string $expression) {
            return "<?php echo date('d/m/Y', strtotime($expression)); ?>";
        });

        Blade::directive('money', function ($amount) {
            return "<?php echo 'R$ ' . number_format($amount, 2,',','.'); ?>";
        });

        Blade::directive('statusPedido', function ($id_status) {
            return  "<?php echo match($id_status) {
                0 => 'Cancelado',
                1 => 'Aguardando Pagamento',
                2 => 'Processando Pagamento',
                3 => 'Pagamento Aprovado',
                4 => 'Em Produção',
                5 => 'Pedido Finalizado',
                6 => 'Pedido Entregue',
                default => ''
            };
            ?>";
        });

       
    }
}
