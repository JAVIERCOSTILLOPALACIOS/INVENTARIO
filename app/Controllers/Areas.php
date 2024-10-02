<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AreasModel;

class Areas extends BaseController
{

    public $helpers = ['form'];

    protected $areasModel;

    public function __construct()
    {
        $this->areasModel = new AreasModel(); // Inicializa el modelo
    }
   
   
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['areas'] = $this->areasModel->findAll(); // Obtener todas las áreas
        return view('areas', $data); // Asegúrate de que estás pasando $data
    }


}
