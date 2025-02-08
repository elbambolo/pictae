<?php

namespace App\Models;

use CodeIgniter\Model;

class ExifModel extends Model
{
    protected $table      = 'exif';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_foto', 'modello', 'apertura', 'esposizione', 'iso', 'focale', 'data_ora'];

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
        'id_foto'    => 'required|integer',
        'modello'    => 'required|string|max_length[255]',
        'apertura'   => 'required|string|max_length[50]',
        'esposizione'=> 'required|string|max_length[50]',
        'iso'        => 'required|integer',
        'focale'     => 'required|string|max_length[50]',
        'data_ora'   => 'required|valid_date'
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
     * Aggiunge i dati EXIF di una foto nel database.
     *
     * @param int $id_foto L'ID della foto.
     * @param string $modello Il modello della fotocamera.
     * @param string $apertura L'apertura del diaframma.
     * @param string $esposizione Il tempo di esposizione.
     * @param int $iso Il valore ISO.
     * @param string $focale La lunghezza focale.
     * @param string $data_ora La data e l'ora dello scatto.
     * @return void
     */
    public function aggiungiExif($id_foto, $modello, $apertura, $esposizione, $iso, $focale, $data_ora)
    {
        $this->insert([
            'id_foto'     => $id_foto,
            'modello'     => $modello,
            'apertura'    => $apertura,
            'esposizione' => $esposizione,
            'iso'         => $iso,
            'focale'      => $focale,
            'data_ora'    => $data_ora
        ]);
    }

    /**
     * Retrieve the EXIF data for a given photo.
     *
     * @param int $id_foto The ID of the photo.
     * @return mixed The EXIF data of the photo, or null if not found.
     */
    public function getExif($id_foto)
    {
        return $this->where('id_foto', $id_foto)->first();
    }

    /**
     * Update the EXIF data for a given photo.
     *
     * @param int $id_foto The ID of the photo.
     * @param string $modello The camera model.
     * @param string $apertura The aperture value.
     * @param string $esposizione The exposure time.
     * @param int $iso The ISO value.
     * @param string $focale The focal length.
     * @param string $data_ora The date and time of the shot.
     * @return void
     */
    public function aggiornaExif($id_foto, $modello, $apertura, $esposizione, $iso, $focale, $data_ora)
    {
        $this->update($id_foto, [
            'modello'     => $modello,
            'apertura'    => $apertura,
            'esposizione' => $esposizione,
            'iso'         => $iso,
            'focale'      => $focale,
            'data_ora'    => $data_ora
        ]);
    }

    /**
     * Delete the EXIF data for a given photo.
     *
     * @param int $id_foto The ID of the photo.
     * @return void
     */
    public function eliminaExif($id_foto)
    {
        $this->where('id_foto', $id_foto)->delete();
    }
}