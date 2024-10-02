<?php

namespace App\Controllers;

use App\Models\TipoAparatosModel; // Asegúrate de usar el modelo correcto
class Tipo_aparatos extends BaseController
{

    public $helpers = ['form'];

    protected $tipoModel;

    public function __construct()
    {
        $this->tipoModel = new TipoAparatosModel(); // Inicializa el modelo
    }
   
   
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['tipos_aparatos'] = $this->tipoModel->findAll(); // Obtener todos los tipos
        return view('tipos_aparatos', $data); // Asegúrate de que estás pasando $data
    }


}
