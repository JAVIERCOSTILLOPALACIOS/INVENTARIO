<?php

namespace App\Controllers;

use App\Models\ResponsivasModel;
use App\Models\EmpleadosModel;
use App\Models\AparatosModel;
use CodeIgniter\Controller;


class Responsivas extends BaseController
{
    protected $responsivasModel;
    protected $empleadosModel;
    protected $aparatosModel;
    protected $pdfGenerator;

    public function __construct()
    {
        $this->responsivasModel = new ResponsivasModel();
        $this->empleadosModel = new EmpleadosModel();
        $this->aparatosModel = new AparatosModel();
       
    }


    public function index()
    {
        $data['responsivas'] = $this->responsivasModel->findAll();
        return view('responsivas', $data);
    }

    public function create()
    {
        $data['empleados'] = $this->empleadosModel->findAll();
        $data['aparatos'] = $this->aparatosModel->findAll();
        return view('create_responsivas', $data);
    }

    public function new()
    {
        $rules = [
            'idEmpleado' => 'required|is_not_unique[empleados.idEmpleado]',
            'idAparato' => 'required|is_not_unique[aparatos.idAparato]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost();

        // Insertar nueva responsiva
        $idResponsiva = $this->responsivasModel->insert([
            'idEmpleado' => trim($post['idEmpleado']),
            'idAparato' => trim($post['idAparato']),
            'fecha_inicio' => date('Y-m-d H:i:s'),
            'fecha_fin' => null,
        ]);



        return redirect()->to('responsivas');
    }

   




    public function darBaja($id = null)
    {
        $responsiva = $this->responsivasModel->find($id);
        if (!$responsiva) {
            return redirect()->to('/responsivas')->with('error', 'Responsiva no encontrada.');
        }

        // Actualiza la fecha_fin con la fecha actual
        $this->responsivasModel->update($id, [
            'fecha_fin' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/responsivas');
    }
}