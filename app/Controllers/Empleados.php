<?php
    namespace App\Controllers;
    use App\Models\AreasModel;
    use App\Models\EmpleadosModel;
    use App\Models\ResponsivasModel;
    use CodeIgniter\RESTful\ResourceController;
    

class Empleados extends ResourceController
{
  


        // En tu controlador
        public function index() {
            $empleadosModel = new EmpleadosModel();
            $data['empleados'] = $empleadosModel->findAll();
            return view('empleados', $data);
        }
        protected $empleadosModel;
    protected $areasModel;

    public function __construct()
    {
        $this->empleadosModel = new EmpleadosModel();
        $this->areasModel = new AreasModel();
    }

    public function create()
    {
        $data['areas'] = $this->areasModel->findAll(); // Obtiene todas las áreas
        return view('create_empleados', $data);
    }

    public function new()
    {
        $reglas = [
            'nombreCompleto' => 'required',
            'correo' => 'permit_empty|valid_email',
            'areaEmpleado' => 'required|is_not_unique[areas.idArea]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost();

        $this->empleadosModel->insert([
            'nombreCompleto' => trim($post['nombreCompleto']),
            'correo' => $post['correo'] ?? null,
            'areaEmpleado' => trim($post['areaEmpleado']),
        ]);

        return redirect()->to('empleados')->with('success', 'Empleado creado con éxito.');
    }

    public function edit($id = null)
    {
        $empleado = $this->empleadosModel->find($id);
        if (!$empleado) {
            return redirect()->to('/empleados')->with('error', 'Empleado no encontrado.');
        }

        $data['areas'] = $this->areasModel->findAll();
        $data['empleado'] = $empleado;

        return view('edit_empleados', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'nombreCompleto' => 'required',
            'correo' => 'permit_empty|valid_email',
            'areaEmpleado' => 'required|is_not_unique[areas.idArea]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $data = [
            'nombreCompleto' => trim($this->request->getPost('nombreCompleto')),
            'correo' => $this->request->getPost('correo'),
            'areaEmpleado' => $this->request->getPost('areaEmpleado'),
        ];

        $this->empleadosModel->update($id, $data);

        return redirect()->to('/empleados')->with('success', 'Empleado actualizado correctamente.');
    }

    public function delete($id = null)
    {
        $model = new EmpleadosModel();
        $builder = $model->builder();
        $builder->where('idEmpleado', $id);
    
        try {
            if ($builder->delete()) {
                session()->setFlashdata('success', 'Empleado eliminado correctamente.');
            } else {
                session()->setFlashdata('error', 'Error al eliminar el empleado.');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', 'No se puede eliminar el empleado porque está en uso.');
        }
    
        return redirect()->to('empleados');
    }

}