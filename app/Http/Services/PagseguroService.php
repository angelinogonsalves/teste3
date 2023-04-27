<?php

namespace App\Http\Services;

use App\Models\Pedido;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;

class PagseguroService {

    //Variaveis Ambente Teste // em produção deixar comentado
/*
    private $ambiente = 'H';    
    private $pagseguro_token = 'E05FF0D44BBB4C48992341397531A9B8'; //teste
*/

    // Vairaiaveis em Ambinete de produçao
    private $ambiente = 'P'; 
    private $pagseguro_token = '0bde81b7-48a4-42d6-aff7-185044813948a2c489cd4df9b1de4ab298d4187959b1a2db-7b73-42d7-9a24-afc9f8f88086'; //Produção
    
    private $pagseguro_email = 'contato@razzaesportes.com.br';
    private $email_comprador_teste = 'c52908781517497584391@sandbox.pagseguro.com.br';    


    public function consultaPedido(Pedido $pedido)
    {   
       
        return $this->getStatusPagamento($pedido);            
        
    }

    public function checkout(Pedido $pedido)
    {                 
      // depois mudar pra pegar do banco       

        if ($pedido) {
            if (!empty($pedido->id_pagseguro)) {              
                if ($this->ambiente == 'H') {
                    $url = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;
                } else {
                    $url = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;   
                }

                return response()->json(['success' => true,'url' => $url]);                 
            }

            if (!$pedido->user_id) {
                return response()->json(['success' => false, 'message' => 'Usuário não vinculado ao pedido']);    
            }
             
            $usuario = User::find($pedido->user_id);                      

            $data['currency'] = 'BRL';
    
            $data['itemId1'] = substr('000000' . $pedido->id,6);
            $data['itemDescription1'] = 'Pedido N° ' . $pedido->id .  ' Razza Esportes';   
            $data['itemAmount1'] = number_format($pedido->valor,2);
            $data['itemQuantity1'] = 1;           

 
            $data['reference'] = strtoupper(md5(rand()));

            if ($this->ambiente == 'H')
            {
                $data['senderEmail'] = $this->email_comprador_teste;
                $data['nome_comprador'] = '';
                $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout?email=$this->pagseguro_email&token=$this->pagseguro_token";
            } else
            {
                $data['senderEmail'] = $usuario->email;
                $data['senderName'] = $usuario->nome;
                $urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/checkout?email=$this->pagseguro_email&token=$this->pagseguro_token";
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
                    $pedido->tipo_pagamento = 'C';
                    $pedido->save();
                }    

                if ($this->ambiente == 'H') {
                    $url = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;
                } else {
                    $url = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;                    
                }
                
                return response()->json(['success' => true,'url' => $url]);   

            } catch (Exception $e){              
                return response()->json(['success' => false, 'message' => $e->getMessage()]); 
            }     
        }  
    }        

    private function getStatusPagamento(Pedido $pedido)
    {
        try {                     
            $data['currency'] = 'BRL';
            if ($this->ambiente == 'H')
            {
                $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=$this->pagseguro_email&token=$this->pagseguro_token&reference=$pedido->cod_referencia";
            } else {
                $urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/transactions?email=$this->pagseguro_email&token=$this->pagseguro_token&reference=$pedido->cod_referencia";
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

                if (isset($xmlObject->transactions)){

                    $trans = $xmlObject->transactions->transaction[0];         

                    if (($pedido) && $trans )
                    {                                                 
                        $data = (strtotime($trans->lastEventDate));
                                                              
                        $pedido->total_recebido = $trans->grossAmount;
                        $pedido->total_liquido = $trans->netAmount;                 
                        $pedido->data_pagamento =date('Y-m-d H:i:s',$data);             
                        
                        if (($pedido->status_pagamento == 3) || ($pedido->status_pagamento == 4)) {
                            $pedido->status = 3;
                        }
                        $pedido->save();      
                    }
                }   
                return response()->json(['success' => true, 'message' => 'Status atualizado']);          
            }            
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]); 
        }
    } 

} //]End Class
