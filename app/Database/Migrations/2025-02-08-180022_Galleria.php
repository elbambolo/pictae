<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Galleria extends Migration
{
    public function up()
    {
        //Campi necessari alla creazione della tabella Galleria
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'titolo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'descrizione' => [
                'type' => 'TEXT',
            ],
            'id_proprietario' => [
                'type' => 'INT'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'privata' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('galleria');
    }

    public function down()
    {
        $this->forge->dropTable('galleria');
    }
}
