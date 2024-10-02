<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table            = 'empleados';
    protected $primaryKey       = 'idEmpleado';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'nombreCompleto',
            'correo' ,
            'areaEmpleado',];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';




}
