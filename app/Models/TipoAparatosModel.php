<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoAparatosModel extends Model
{
    protected $table            = 'tipo_aparatos';
    protected $primaryKey       = 'idTipo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombreTipo'];

    // Dates
    protected $useTimestamps = false;
    public function getTipoAparatos()
    {
        return $this->findAll(); // Retorna todas las áreas
    }
}
