<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PagSeguroController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
     
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    public function pagseguro(Pedido $pedido)
    {
        $success = true;
        $msg = '';      
      // depois mudar pra pegar do banco
        $ambiente = 'H';
        $pagseguro_token = 'A4E6E0AFA50F4C6F9C7BB4D18667F887';
        $pagseguro_email = 'cooperanet.br@gmail.com';
        $email_comprador_teste = 'c46643784810296169657@sandbox.pagseguro.com.br';

        if ($pedido)
        {
            if (!empty($pedido->id_pagseguro)) {              
                if ($ambiente == 'H') {
                    $url = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;
                } else {
                    $url = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;   
                }

                return response()->json(['success' => true,'url' => $url]);                 
            }

            if (!$pedido->user_id) {
                return response()->json(['success' => false, 'msg_erro' => 'Usuário não vinculado ao pedido']);    
            }
             
            $usuario = User::find($pedido->user_id);                      

            $data['currency'] = 'BRL';
    
            $data['itemId1'] = substr('000000' . $pedido->id,6);
            $data['itemDescription1'] = 'Pedido N° ' . $pedido->id .  ' Razza Esportes';   
            $data['itemAmount1'] = number_format($pedido->valor,2);
            $data['itemQuantity1'] = 1;           

          /*  $data['itemId2'] = '000002';
            $data['itemDescription2'] = 'Frete';   
            $data['itemAmount2'] = number_format(0,2);
            $data['itemQuantity2'] = 1;           
            */
            $data['reference'] = strtoupper(md5(rand()));

            if ($ambiente == 'H')
            {
                $data['senderEmail'] = $email_comprador_teste;
                $data['nome_comprador'] = '';
                $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout?email=$pagseguro_email&token=$pagseguro_token";
            } else
            {
                $data['senderEmail'] = $usuario->email;
                $data['senderName'] = $usuario->nome;
                $urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/checkout?email=$pagseguro_email&token=$pagseguro_token";
            }             
                    
           // $data['redirectURL'] = url('/meuspedidos/' .  $pedido->id);
           // $data['notificationURL'] = "https://razzapro.com.br/api/pagseguro/retornopagamento";

            $data['shippingAddressRequired'] = "false";

            $client = new Client();
            try {
                $result = $client->post($urlPagseguro, [
                    'headers' => [              
                        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'                 
                        ],
                    'form_params' => $data               
                    ]
                );
                              
                if ($result->getStatusCode() == 200){                
                    $xml = $result->getBody()->getContents();
                                        
                    $xmlObject = simplexml_load_string($xml);
                 
                    $pedido->id_pagseguro = json_decode(json_encode($xmlObject),true)["code"];
                    $pedido->cod_referencia =  $data['reference']; 

                    $pedido->status = 2;                
                    $pedido->save();
                }    

                if ($ambiente == 'H') {
                    $url = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;
                } else {
                    $url = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;                    
                }
                
                return response()->json(['success' => true,'url' => $url]);   

            } catch (Exception $e){              
                return response()->json(['success' => false, $e->getMessage()]); 
            }     
        }          
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
