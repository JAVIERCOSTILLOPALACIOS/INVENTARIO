<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Area extends Migration
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
        $this->forge->createTable('areas');

    }

    public function down()
    {
        $this->forge->dropTable('areas');
    }
}
