<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImagemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function corta(Request $request)
    {       
        if(isset($_POST["image"]))
        {        
            $data = $_POST["image"];
            $destino = $_POST["destino"];
         
            $image_array_1 = explode(";", $data);
            
            $image_array_2 = explode(",", $image_array_1[1]);
            
            $data = base64_decode($image_array_2[1]);             
                        
            $name = md5(time()) . '.png';

            Storage::disk('produtos')->put($name, $data);  

            $url = Storage::disk('produtos')->url($name);      
            
            $name_input = ($destino == 'imagem_tamanhos' ? 'foto_tamanho[]' : 'foto_produto[]');
                                    
            echo  '<div class="col-md-4 imgProduto">  ' . 
                '   <div class="form-group"> ' . 
                '     <img src="'.$url.'" class="img-thumbnail" id="img_produto" name="img_produto" data-nome="' . $name . '"/>' .                           
                '     <input type="hidden" name="'.$name_input.'" value="'.$name.'">'.
                '     <div class="row text-center"> ' .
                '       <div class="col-md-12">   ' .                  
                '         <button class="btn btn-danger btnexcluiimagem" onclick="excluiimagem(this)"><i class="fas fa-times-circle"> </i>Remover</button>   ' .
                '       </div>  ' .
                '     </div>  ' .                
                '   </div> ';    
                ' </div> ';                                         
        }      
    }

    public function criaLink(){
        return Artisan::call('storage:link');
    }

}
