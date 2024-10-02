<?php
namespace App\Controllers;

use App\Models\AparatosModel;
use App\Models\AreasModel;
use App\Models\ResponsivasModel;
use App\Models\TipoAparatosModel;
use CodeIgniter\RESTful\ResourceController;

class Aparatos extends ResourceController
{
    protected $aparatosModel;
    protected $tipoAparatosModel;
    protected $areasModel;

    public function __construct()
    {
        $this->aparatosModel = new AparatosModel();
        $this->tipoAparatosModel = new TipoAparatosModel();
        $this->areasModel = new AreasModel();
    }

  
    public function index()
    {
        $data['aparatos'] = $this->aparatosModel->AparatosTipo(); // Llama al método que obtiene los datos
        $data['aparatos'] = $this->aparatosModel->AparatosArea(); // Llama al método que obtiene los datos
        return view('aparatos', $data); // Devuelve la vista con los datos
    }
    
        
        
    

    public function create()
    {
        $data['tipos'] = $this->tipoAparatosModel->findAll(); // Obtiene todos los tipos
        $data['areas'] = $this->areasModel->findAll(); // Obtiene todas las áreas

        return view('create_aparatos', $data);
    }

    public function new()
    {
        $reglas = [
            'tipo'    => 'required|is_not_unique[tipo_aparatos.idTipo]',
            'marca'   => 'required',
            'modelo'  => 'required',
            'serie'   => 'required',
            'disco'   => 'permit_empty|decimal',
            'ram'     => 'permit_empty|decimal',
            'so'      => 'permit_empty',
            'propiedad'=> 'permit_empty',
            'acciones' => 'permit_empty',
            'valor_compra' => 'permit_empty|decimal',
            'fecha_compra' => 'permit_empty',
            'area'    => 'required|is_not_unique[areas.idArea]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost();

        $this->aparatosModel->insert([
            'tipo'     => trim($post['tipo']),
            'marca'    => trim($post['marca']),
            'modelo'   => trim($post['modelo']),
            'serie'    => trim($post['serie']),
            'disco'    => $post['disco'] ?? null,
            'ram'      => $post['ram'] ?? null,
            'so'       => $post['so'] ?? null,
            'propiedad'=> $post['propiedad'] ?? null, 
            'acciones' => $post['acciones'] ?? null,
            'fecha_compra' => $post['fecha_compra'] ?? null,
            'valor_compra' => $post['valor_compra'] ?? null,
            
            'area'     => trim($post['area']),
        ]);

        return redirect()->to('aparatos')->with('success', 'Aparato creado con éxito.');
    }

    public function edit($id=null)
    {
        // Fetch the aparato by ID
        $aparato = $this->aparatosModel->find($id);
        if (!$aparato) {
            return redirect()->to('/aparatos')->with('error', 'Aparato no encontrado.');
        }

        // Fetch tipos and areas for the select options
        $data['tipos'] = $this->tipoAparatosModel->findAll();
     
        $data['areas'] = $this->areasModel->findAll();
        $data['aparato'] = $aparato;

        return view('edit_aparatos', $data);
    }

    public function update($id=null)
    {
        // Validate the input
        $rules = [
            'tipo' => 'required|is_not_unique[tipo_aparatos.idTipo]',
            'marca' => 'required',
            'modelo' => 'required',
            'serie' => 'required',
            'area' => 'required|is_not_unique[areas.idArea]',
            'disco' => 'permit_empty|decimal',
            'ram' => 'permit_empty|decimal',
            'so' => 'permit_empty',
            'propiedad' => 'permit_empty',
            'acciones' => 'permit_empty',
            'valor_compra' => 'permit_empty|decimal',
            'fecha_compra' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        // Prepare data for update
        $data = [
            'tipo' => $this->request->getPost('tipo'),
            'marca' => trim($this->request->getPost('marca')),
            'modelo' => trim($this->request->getPost('modelo')),
            'serie' => trim($this->request->getPost('serie')),
            'area' => $this->request->getPost('area'),
            'disco' => $this->request->getPost('disco'),
            'ram' => $this->request->getPost('ram'),
            'so' => $this->request->getPost('so'),
            'propiedad' => $this->request->getPost('propiedad'),
            'acciones' => $this->request->getPost('acciones'),
            'fecha_compra' => $this->request->getPost('fecha_compra'),
            'valor_compra' => $this->request->getPost('valor_compra'),
            
        ];

        // Update the aparato in the database
        $this->aparatosModel->update($id, $data);

        // Redirect with success message
        return redirect()->to('/aparatos')->with('success', 'Aparato actualizado correctamente.');
    }
    public function delete($id = null)
    {
        $model = new AparatosModel();
        $builder = $model->builder();
        $builder->where('idAparato', $id);
    
        try {
            // Eliminar el aparato sin verificar responsivas
            if ($builder->delete()) {
                session()->setFlashdata('success', 'Aparato eliminado correctamente.');
            } else {
                session()->setFlashdata('error', 'Error al eliminar el aparato.');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', 'No se puede eliminar el aparato porque está en uso.');
        }
    
        return redirect()->to('aparatos');
    }
    
    


}