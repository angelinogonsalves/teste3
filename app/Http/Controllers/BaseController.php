<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class BaseController extends Controller
{
    private function responseSuccess(array $response,string $route,$addIDRota = true) : RedirectResponse
    {
        if ($route){
            $url = $route;

            if (($addIDRota) && (isset($response['result']))) {
                $url .= ($response['result']?->id ? '/'.$response['result']->id : '');
            }
             
            return redirect($url)->with('success', $response['message']);
        }

        return redirect()->back()->with('success', $response['message']);
    }

    private function responseError(array $response) : RedirectResponse
    {
        return redirect()->back()->withErrors($response['message']);
    }

    public function responseData(array $response,string $route,$addIDRota = true) : RedirectResponse
    {
        if ($response["success"] === true){
            return $this->responseSuccess($response,$route,$addIDRota);
        }
        return $this->responseError($response);
    }

    public function formatMoneyBR($value,$addSifrao = false)
    {
        return ($addSifrao ? 'R$ ' : '') . ' ' . number_format($value, 2, ',', '.');
    }
}