<?php

namespace App\Models;

use CodeIgniter\Model;

class ImmaginiModel extends Model
{
    protected $table      = 'immagin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_album', 'nome', 'descrizione', 'percorso', 'created_at', 'updated_at'];

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
        'id_album' => 'required|integer',
        'nome' => 'required|string|max_length[255]',
        'descrizione' => 'permit_empty|string|max_length[500]',
        'percorso' => 'required|string|max_length[255]',
        'created_at' => 'permit_empty|valid_date',
        'updated_at' => 'permit_empty|valid_date'
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

    /**
     * Retrieves all images associated with a specific album.
     *
     * @param int $id_album The ID of the album whose images are to be retrieved.
     * @return array An array of images associated with the specified album.
     */
    public function getImagesByAlbum(int $id_album): array
    {
        return $this->where('id_album', $id_album)->findAll();
    }

    /**
     * Retrieves the image with the specified ID.
     *
     * @param int $id The ID of the image to retrieve.
     * @return array The image record.
     */
    public function getImageById(int $id): array
    {
        return $this->find($id);
    }

    public function insertImmagine($data)
    {
        $this->insert($data);
        return $this->insertID;
    }
}