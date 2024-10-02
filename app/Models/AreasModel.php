<?php

namespace App\Models;

use CodeIgniter\Model;

class AreasModel extends Model
{
    protected $table            = 'areas';
    protected $primaryKey       = 'idArea';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombreArea'];


    // Dates
    protected $useTimestamps = false;
    public function getAreas()
    {
        return $this->findAll(); // Retorna todas las áreas
    }
}
