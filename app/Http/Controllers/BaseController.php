<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;

class BaseController extends Controller
{
    private function responseSuccess(array $response,string $route) : RedirectResponse {
        if ($route){        
            $url = $route;
    
            $url .= ($response['result']?->id ? '/'.$response['result']->id : '');
             
            return redirect($url)->with('success', $response['message']);              
        } 

        return redirect()->back()->with('success', $response['message']);        
    }                 

    private function responseError(array $response) : RedirectResponse  {                
        return redirect()->back()->with('error', $response["message"]);              
    }   

    public function responseData(array $response,string $route) : RedirectResponse  {
        if ($response["success"] === true){
            return $this->responseSuccess($response,$route);
        }
        return $this->responseError($response, $route);
    }
}