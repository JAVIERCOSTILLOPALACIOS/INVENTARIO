<?php

namespace App\Models;

use CodeIgniter\Model;

class AparatosModel extends Model
{



    
    protected $table            = 'aparatos';
    protected $primaryKey       = 'idAparato';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'tipo',
            'marca' ,
            'modelo',
            'serie',
            'disco',
            'ram',
            'so',
            'propiedad', 
            'acciones', 
            'fecha_compra',
            'valor_compra',
           
               'area',];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'date';


    public function obtenerAparatos()
    {
        return $this->db->table('aparatos')
            ->select('aparatos.*, tipo_aparatos.nombreTipo, areas.nombreArea')
            ->join('tipo_aparatos', 'aparatos.tipo = tipo_aparatos.idTipo', 'left')
            ->join('areas', 'aparatos.area = areas.idArea', 'left')
            ->get()
            ->getResultArray();
    }
    public function AparatosTipo()
    {
        return $this->select('aparatos.*, tipo_aparatos.nombreTipo AS tipo')
            ->join('tipo_aparatos', 'aparatos.tipo = tipo_aparatos.idTipo')
            ->findAll();
    }

    public function AparatosArea()
    {
        return $this->select('aparatos.*, areas.nombreArea AS area')
            ->join('areas', 'aparatos.area = areas.idArea')
            ->findAll();
    }




}
