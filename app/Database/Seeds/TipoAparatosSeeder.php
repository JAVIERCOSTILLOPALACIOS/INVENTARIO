<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoAparatosSeeder extends Seeder
{
    public function run()
    {
               // Define las áreas a insertar
               $tipo_aparatos = [
                ['name' => 'Celular'],
                ['name' => 'Laptop'],
                ['name' => 'Mouse'],
                ['name' => 'Monitor'],
           
            ];
    
            // Inserta las áreas en la base de datos
            foreach ($tipo_aparatos as $tipo) {
                $this->db->table('tipo_aparatos')->insert($tipo);
            }
    }
}
