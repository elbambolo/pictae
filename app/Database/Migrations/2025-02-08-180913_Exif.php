<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exif extends Migration
{
    public function up()
    {
        //in questa tabella andiamo a registrare i dati exif delle immagini

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_immagine' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'modello' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'apertura' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'esposizione' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'iso' => [
                'type' => 'INT',
            ],
            'data_ora' => [
                'type' => 'DATETIME',
            ],
            'flash' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'creato_il' => [
                'type' => 'DATETIME',
            ],
            'aggiornato_il' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_immagine', 'immagini', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('exif');
    }

    public function down()
    {
        $this->forge->dropTable('exif');
    }
}
