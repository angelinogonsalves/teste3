<?php

namespace App\Http\Controllers;

use App\Http\Services\PagseguroService;
use App\Models\Pedido;

class PagSeguroController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    private $pagSeguroService;

    public function __construct()
    {
        $this->pagSeguroService = new PagseguroService();             
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */    

    public function pix(Pedido $pedido)
    {
        return $this->pagSeguroService->pix($pedido);
    }

    public function payPix(Pedido $pedido)
    {
        return  $this->pagSeguroService->payPix($pedido);
    }

    public function pagseguro(Pedido $pedido)
    {
        return  $this->pagSeguroService->checkout($pedido);
    }

    public function consulta(Pedido $pedido)
    {
        return $this->pagSeguroService->consultaPedido($pedido);
    }


   /* public function retornopagamento(Request $request){
     $notificationCode =$request->notificationCode;
     Log::debug("notificationCode:".$notificationCode);   
     if (!empty($notificationCode)){
       

        $parametro = Parametro::find(1);   
   
        $token = $parametro->pagseguro_token;
        $email = $parametro->pagseguro_email;  
   
        if ($parametro->pagseguro_ambiente == 'H')
        {
           $url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/$notificationCode?email=$email&token=$token";
        } else {
            $url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/$notificationCode?email=$email&token=$token";
        }


        $result = $client->get($url);       
            
        if ($result->getStatusCode() == 200){                
            $xml = $result->getBody()->getContents();
                              
            $xmlObject = simplexml_load_string($xml);
         
            $pedido = Pedido::find('cod_referencia',$xmlObject->reference)->first();  
                        
            if ($pedido) {
                                        
                $data = (strtotime($xmlObject->lastEventDate));
                                
                $pedido->total_recebido = $xmlObject->grossAmount;
                $pedido->total_liquido = $xmlObject->netAmount;
                $pedido->status_pagamento = $xmlObject->status;
                $pedido->data_pagamento =date('Y-m-d H:i:s',$data);             
                
                if (($pedido->status_pagamento == 3) || ($pedido->status_pagamento == 4))
                {
                    $pedido->status_pedido = 3;
                }
                $pedido->save();      
            }
        }
                       
     }
    
    }


    public function consultaStatus($id_referencia)
    {    
        if (strlen($id_referencia) > 0) 
        {
            $this->getStatusPagamento($id_referencia);
        }     
    }
*/
/*
    public function getStatusPagamento($reference)
    {
        try {      
            $parametro = Parametro::find(1);   

    
            $token = $parametro->pagseguro_token;
            $email = $parametro->pagseguro_email;  

            $data['currency'] = 'BRL';
            if ($parametro->pagseguro_ambiente == 'H')
            {
                $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=$email&token=$token&reference=$reference";
            }
            else
            {
                $urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/transactions?email=$email&token=$token&reference=$reference";
            }             
        
            $client = new Client();
    
            $result = $client->get($urlPagseguro, [
                    'headers' => [              
                        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'                 
                        ],                   
                    ]
            );
        
            if ($result->getStatusCode() == 200){
        
        
                $xml = $result->getBody()->getContents();
                                                    
                $xmlObject = simplexml_load_string($xml);

                $pedido = Pedido::where('cod_referencia',$reference)->first();  
            
                $trans = $xmlObject->transactions->transaction[0];         

                if (($pedido) && $trans )
                {      
                                           
                    $data = (strtotime($trans->lastEventDate));
                                    
                    $pedido->total_recebido = $trans->grossAmount;
                    $pedido->total_liquido = $trans->netAmount;
                    $pedido->status_pagamento = $trans->status;
                    $pedido->data_pagamento =date('Y-m-d H:i:s',$data);             
                    
                    if (($pedido->status_pagamento == 3) || ($pedido->status_pagamento == 4))
                    {
                        $pedido->status_pedido = 3;
                    }
                    $pedido->save();      
                }
            }            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } 
          */                          

        /*
                1 Aguardando pagamento
                
                O comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.
                
                2
                
                Em análise
                
                O comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.
                
                3
                
                Paga
                
                A transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.
                
                4
                
                Disponível
                
                A transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
                
                5
                
                Em disputa
                
                O comprador, dentro do prazo de liberação da transação, abriu uma disputa.
                
                6
                
                Devolvida
                
                O valor da transação foi devolvido para o comprador.
                
                7
                
                Cancelada
                
                A transação foi cancelada sem ter sido finalizada.
                
    }
    */
}
