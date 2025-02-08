<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Album extends Migration
{
    public function up()
    {
        //In questo migration andiamo ad inserire il database per la tabella Album

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
            'id_galleria' => [
                'type' => 'INT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'privato' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_proprietario', 'utenti', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_galleria', 'galleria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('album');
    }

    public function down()
    {
        $this->forge->dropTable('album');
    }
}
