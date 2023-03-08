<?php

namespace App\Http\Controllers;

use App\Http\Services\ModalidadeService;

class ModalidadeController extends Controller
{
    public $modalidadeService;

    public function __construct()
    {
        $this->modalidadeService = new ModalidadeService();
    }

    public function listAllModalidades() {
        return $this->modalidadeService->getAllModalidades();
    }

    public function index()
    {        
      
    }
}
