<?php

namespace App\Controllers;
use CodeIgniter\Files\File;


class Upload extends BaseController
{
    public function getIndex()
    {
        return view('upload');
    }

    public function postUploadImage()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => 'uploaded[userfile]'
                    . '|is_image[userfile]'
                    . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[userfile,4096]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $files = $this->request->getFiles();
        $uploadedFiles = [];

        foreach ($files['userfile'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $file->store();
                $uploadedFiles[] = new File($filepath);
            }
        }

        if (empty($uploadedFiles)) {
            return redirect()->back()->with('error', 'No files were uploaded.');
        }

        $data = [
            'uploaded_fileinfo' => $uploadedFiles,
        ];

        return view('upload_success', $data);
    }
}