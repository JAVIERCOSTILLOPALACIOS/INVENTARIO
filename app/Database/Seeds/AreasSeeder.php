<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AreasSeeder extends Seeder
{
    public function run()
    {
        // Define las áreas a insertar
        $areas = [
            ['name' => 'Anexo 24/30'],
            ['name' => 'Consultoría'],
            ['name' => 'Auditoría'],
            ['name' => 'Administración'],
            ['name' => 'Desarrollo de negocios'],
            ['name' => 'IT'],
        ];

        // Inserta las áreas en la base de datos
        foreach ($areas as $area) {
            $this->db->table('areas')->insert($area);
        }
    }
}
