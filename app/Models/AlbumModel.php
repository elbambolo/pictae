<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table      = 'album';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['titolo', 'descrizione', 'id_proprietario', 'created_at', 'updated_at', 'privata'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'titolo' => 'required|string|max_length[255]',
        'descrizione' => 'permit_empty|string|max_length[1000]',
        'id_proprietario' => 'required|integer',
        'created_at' => 'permit_empty|valid_date',
        'updated_at' => 'permit_empty|valid_date',
        'privata' => 'required|boolean'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    //metto solo le funzioni principali, poi mano a mano che facciamo i controller le aggiungo
    /**
     * Retrieves all albums owned by a specific owner.
     *
     * @param int $id_proprietario The ID of the owner whose albums are to be retrieved.
     * @return array An array of albums owned by the specified owner.
     */

    public function getAlbumsByOwner(int $id_proprietario)
    {
        return $this->where('id_proprietario', $id_proprietario)->findAll();
    }
}