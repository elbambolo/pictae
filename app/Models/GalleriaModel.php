<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleriaModel extends Model
{
    protected $table      = 'galleria';
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
        'titolo' => 'required|max_length[255]',
        'descrizione' => 'permit_empty|max_length[500]',
        'id_proprietario' => 'required|integer',
        'created_at' => 'permit_empty|valid_date',
        'updated_at' => 'permit_empty|valid_date',
        'privata' => 'required|in_list[0,1]'
    ];

    // nel validationmessages, dobbiamo andare ad impostare i messaggi di errore per ogni regola di validazione
    // con la gestione delle traduzioni che andremmo ad implementare in seguito
    // per ora lasciamo in bianco
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
     * Retrieves all galleries associated with a specific owner.
     *
     * @param int $id_proprietario The ID of the owner whose galleries are to be retrieved.
     * @return array An array of gallery records associated with the specified owner.
     */
    public function getGallerie($id_proprietario)
    {
        return $this->where('id_proprietario', $id_proprietario)->findAll();
    }

    /**
     * Retrieves the list of all galleries.
     *
     * @return array The list of galleries.
     */
    public function getListaGallerie()
    {
        return $this->findAll();
    }

    /**
     * Adds a new gallery entry to the database.
     *
     * @param array $data An associative array containing the gallery data to be inserted.
     * @return bool|int Returns the insert ID on success, or false on failure.
     */
    public function addGalleria($data)
    {
        return $this->insert($data);
    }

    /**
     * Deletes a gallery record from the database.
     *
     * @param int $id_galleria The ID of the gallery to be deleted.
     * @return bool True on success, false on failure.
     */
    Public function delGalleria($id_galleria)
    {
        return $this->delete($id_galleria);
    }

    //le altre funzioni le vado a scrivere mano a mano che mi servono
}