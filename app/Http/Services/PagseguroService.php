<?php

namespace App\Http\Services;

use App\Models\Pedido;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

    public function checkout(Request $request, Pedido $pedido)
    {                 
        // depois mudar pra pegar do banco       
        
        $others = $request->input('others', []);
        $outros_pedidos = [];
        $outros_valores = 0;

        if ($pedido) {

            if ($others && !empty($others)) {
                foreach($others as $i => $id_pedido) {
                    $outros_pedidos[$id_pedido] = Pedido::find($id_pedido);
                    $outros_valores += $outros_pedidos[$id_pedido]->valor;

                    if (!$outros_pedidos[$id_pedido]->user_id) {
                        return response()->json(['success' => false, 'message' => 'Usuário não vinculado ao pedido']);    
                    }

                    $data['itemId'.$i] = substr('000000' . $outros_pedidos[$id_pedido]->id,6);
                    $data['itemDescription'.$i] = 'Pedido N° ' . $outros_pedidos[$id_pedido]->id .  ' Razza Esportes';   
                    $data['itemAmount'.$i] = number_format($outros_pedidos[$id_pedido]->valor,2);
                    $data['itemQuantity'.$i] = 1; 

                }
            } 

            else {

                if (!$pedido->user_id) {
                    return response()->json(['success' => false, 'message' => 'Usuário não vinculado ao pedido']);    
                }

                $data['itemId1'] = substr('000000' . $pedido->id,6);
                $data['itemDescription1'] = 'Pedido N° ' . $pedido->id .  ' Razza Esportes';   
                $data['itemAmount1'] = number_format($pedido->valor+$outros_valores,2);
                $data['itemQuantity1'] = 1;  

            }

            // if (!empty($pedido->id_pagseguro)) {              
            //     if ($this->ambiente == 'H') {
            //         $url = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;
            //     } else {
            //         $url = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='.$pedido->id_pagseguro;   
            //     }

            //     return response()->json(['success' => true,'url' => $url]);                 
            // }

            
             
            $usuario = User::find($pedido->user_id);                      

            $data['currency'] = 'BRL'; 
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

                    if (!empty($outros_pedidos)) {
                        foreach($outros_pedidos as $outro_pedido) {
                            $outro_pedido->id_pagseguro = $pedido->id_pagseguro;
                            $outro_pedido->cod_referencia = $pedido->cod_referencia;
                            $outro_pedido->status = $pedido->status; 
                            $outro_pedido->tipo_pagamento = $pedido->tipo_pagamento;
                            $pedido->save();
                        }
                    }

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
                        
                        // Paga ou Disponível -- https://m.pagseguro.uol.com.br/v3/guia-de-integracao/consulta-de-transacoes-por-intervalo-de-datas.html?_rnt=dd#!rmcl
                        if (($trans->status == 3) || ($trans->status == 4)) {
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
