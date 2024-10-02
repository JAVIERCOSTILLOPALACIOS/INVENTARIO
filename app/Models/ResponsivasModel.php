<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponsivasModel extends Model
{
    protected $table = 'responsivas';
    protected $primaryKey = 'idResponsiva';
    protected $allowedFields = ['idEmpleado', 'idAparato', 'fecha_inicio', 'fecha_fin'];
    protected $useTimestamps = false;
}
