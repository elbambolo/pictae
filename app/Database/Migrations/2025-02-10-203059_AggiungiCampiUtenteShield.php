<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

class AggiungiCampiUtenteShield extends Migration
{
    /**
     * @var string[]
     */
    private array $tables;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var \Config\Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up()
    {
        $fields = [
            'telefono' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'fotoProfilo' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'facebook' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'twitter' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'instagram' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'linkedin' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'youtube' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'twitch' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'tiktok' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'thread' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'sitoWeb' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],

        ];
        $this->forge->addColumn($this->tables['users'], $fields);
    }

    public function down()
    {
        $fields = [
            'telefono',
            'fotoProfilo',
            'facebook',
            'twitter',
            'instagram',
            'linkedin',
            'youtube',
            'twitch',
            'tiktok',
            'thread',
            'sitoWeb',
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
