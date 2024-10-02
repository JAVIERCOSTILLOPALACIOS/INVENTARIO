<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoAparato extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type' => 'INT',
                'constraint' =>5,
                'unsigned'=>true,
                'auto_increment' =>true,
            ],
            'name'=>[
                'type' => 'VARCHAR',
                'constraint' =>20,
            ],
        ]);

        $this->forge->addKey('id',true);
        $this->forge->createTable('tipo_aparatos');

    }

    public function down()
    {
        $this->forge->dropTable('tipo_aparatos');
    }
}
