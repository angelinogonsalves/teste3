<?php

namespace App\Http\Services;

use App\Models\Pedido;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;

class PagseguroService {

    private $ambiente = 'H';
    
   
    private $pagseguro_token = 'E05FF0D44BBB4C48992341397531A9B8'; //teste
    private $pagseguro_email = 'contato@razzaesportes.com.br';
    private $email_comprador_teste = 'c52908781517497584391@sandbox.pagseguro.com.br';    


//comprador de testes h85l59c8340y4674copiar

    public function geraURLQrCode(Pedido $pedido) 
    {
        return $this->getbaseURLPagseguro() . "/qrcode/{$pedido->id_qrcode}/png"; 
    }   
    
    private function getbaseURLPagseguro(){
        if ($this->ambiente == 'H'){
            return "https://sandbox.api.pagseguro.com";            
        }

        return "https://api.pagseguro.com";
     }

     private function getHeaderPagseguro(){
        return [
            'Authorization' => "Bearer {$this->pagseguro_token}",
            'Content-Type' => 'application/json'
        ];
     }

     private function geraCodReferencia() {
        return strtoupper(md5(rand()));
     }


     public function pix(Pedido $pedido) 
     {

        $body = [
            "reference_id" => $this->geraCodReferencia(),
            "customer" => [
                "name" => $pedido->user->nome,
                "email" => $pedido->user->email,
                "tax_id" => $pedido->user->cpf, // cpf do cliente
                "phones" => [
                    [
                        "country" => "55",
                        "area" => $pedido->user->ddd,
                        "number" => $pedido->user->telefone,
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "name" => "Pedido N° {$pedido->id} Razza Esportes",
                    "quantity" => 1,
                    "unit_amount" => $pedido->valor * 100,
                ]
            ],
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => $pedido->valor * 100
                    ]
                ]
            ],      
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ]; 

        try {
    
            $client = new Client([
                'base_uri' =>  $this->getbaseURLPagseguro(),
            ]);

            $response = $client->post('orders', [       
                'body' => json_encode($body),
                'headers' => $this->getHeaderPagseguro()             
            ]);
    
            $content = json_decode($response->getBody());            

            $qr_code = $content->qr_codes[0]->id;    

            $pedido->id_pagseguro = $content->id;
            $pedido->cod_referencia = $content->reference_id;
            $pedido->tipo_pagamento = 'P';
            $pedido->id_qrcode = $qr_code;
            $pedido->save();

            $url_pix = $this->geraURLQrCode($pedido);
                     
            return response()->json(['success' => true, "qr_code" =>$url_pix,"message" => "Realize o pagamento através do QR gerado na tela"]);
        } catch (Exception $e){             
            return response()->json(['success' => false, "message" => $e->getMessage()]); 
        }        
    }

    public function payPix(Pedido $pedido)
    {   
        try {
            $client = new Client([
                'base_uri' => $this->getbaseURLPagseguro(),
            ]);        
        $result = $client->post("/pix/pay/{$pedido->id_qrcode}", [                 
            'headers' => $this->getHeaderPagseguro()
        ]);

            $response = $result->getBody()->getContents();
        
            if ($result->getStatusCode() == 200){                                                   
                return response()->json(['success' => true, 'response' => $response]); 
            }

            return response()->json(['success' => false, 'response' => $response]); 
        } catch (Exception $e){                  
            return response()->json(['success' => false, 'message' => $e->getMessage()]); 
        }  
    }

    private function consultaStatusPix(Pedido $pedido) {         
         try {
            $client = new Client([
                'base_uri' => $this->getbaseURLPagseguro(),
            ]);        
            $result = $client->get("/orders/{$pedido->id_pagseguro}", [                 
                'headers' => $this->getHeaderPagseguro()
            ]);
       
            if ($result->getStatusCode() == 200){                     
                $response = json_decode($result->getBody()->getContents());
           
                if (isset($response->charges)) {
                    $charge = $response->charges[0];   
                    
                    if ($charge->status == 'PAID') {
                        $pedido->status = 3;
                    } else {
                        $pedido->status = 1;
                    }
                    $pedido->save();
                }             
              
                return response()->json(['success' => true, 'message' => "Pedido atualizado"]); 
            } 

            return response()->json(['success' => false, 'response' => "Falha ao atualizar pedido"]); 
        } catch (Exception $e){                  
            return response()->json(['success' => false, 'message' => $e->getMessage()]); 
        }  
    }

    public function consultaPedido(Pedido $pedido)
    {   
        if ($pedido->tipo_pagamento == 'C') {
            return $this->getStatusPagamento($pedido);            
        }
        return $this->consultaStatusPix($pedido);
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

}
