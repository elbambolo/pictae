<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Immagini extends Migration
{
    public function up()
    {
        //Migration per la creazione della tabella Immagini completa, con chiavi esterne
        //considerando che le immagini avranno anche tutti i dati exif
        //registriamo anche il formato originale dell'immagine per il download dell'immagine originale

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_galleria' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'descrizione' => [
                'type' => 'TEXT',
            ],
            'formato' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'dimensioni' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'data_creazione' => [
                'type' => 'DATETIME',
            ],
            'data_modifica' => [
                'type' => 'DATETIME',
            ],
            'id_proprietario' => [
                'type' => 'INT',
            ],
            'id_album' => [
                'type' => 'INT',
            ],
            'id_exif' => [
                'type' => 'INT',
            ],
            'formato_originale' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('immagini');
    }

    public function down()
    {
        $this->forge->dropTable('immagini');
    }
}
