<?php

namespace App\Controllers;
use CodeIgniter\Files\File;


class Upload extends BaseController
{
    public function getIndex()
    {
        return view('upload');
    }

    /**
     * Handles the image upload process.
     *
     * This method validates the uploaded image file(s) based on the specified rules,
     * processes the upload, and stores the file(s) in the designated directory.
     * If the validation fails or no files are uploaded, it redirects back with an error message.
     * On successful upload, it returns a view with the uploaded file information.
     *
     * Validation rules:
     * - The file must be uploaded.
     * - The file must be an image.
     * - The file must be of type jpg, jpeg, gif, png, or webp.
     * - The file size must not exceed 4096 KB.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|\CodeIgniter\HTTP\Response
     */
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

    /**
     * Resize the given image to the specified width and height.
     *
     * @param string $filepath The path to the image file to be resized.
     * @param int $width The desired width of the resized image.
     * @param int $height The desired height of the resized image.
     * @return string The file path of the resized image.
     */
    public function resizeImage($filepath, $width, $height)
    {
        $image = \Config\Services::image()
            ->withFile($filepath)
            ->resize($width, $height)
            ->save($filepath);

            //return image file path
            return $filepath;
    }

    /**
     * Creates a thumbnail of the specified image.
     *
     * @param string $filepath The path to the original image file.
     * @param int $width The width of the thumbnail.
     * @param int $height The height of the thumbnail.
     * @return string The path to the created thumbnail.
     */
    public function createThumbnail($filepath, $width, $height)
    {
        $thumbnailPath = WRITEPATH . 'uploads/thumbnails/' . basename($filepath);
        $image = \Config\Services::image()
            ->withFile($filepath)
            ->fit($width, $height, 'center')
            ->save($thumbnailPath);

        return $thumbnailPath;
    }

    /**
     * Crops an image to the specified dimensions and saves it.
     *
     * @param string $filepath The path to the image file.
     * @param int $width The width of the cropped area.
     * @param int $height The height of the cropped area.
     * @param int $x The x-coordinate of the top-left corner of the cropped area.
     * @param int $y The y-coordinate of the top-left corner of the cropped area.
     * @return string The path to the cropped image file.
     */
    public function cropImage($filepath, $width, $height, $x, $y)
    {
        $image = \Config\Services::image()
            ->withFile($filepath)
            ->crop($width, $height, $x, $y)
            ->save($filepath);

        return $filepath;
    }

    /**
     * Rotates an image by a specified angle and saves the rotated image.
     *
     * @param string $filepath The path to the image file to be rotated.
     * @param int $angle The angle in degrees to rotate the image.
     * @return string The path to the rotated image file.
     */
    public function rotateImage($filepath, $angle)
    {
        $image = \Config\Services::image()
            ->withFile($filepath)
            ->rotate($angle)
            ->save($filepath);

        return $filepath;
    }

    /**
     * Adds a watermark to an image.
     *
     * @param string $filepath The path to the image file to which the watermark will be added.
     * @param string $watermarkPath The path to the watermark image file.
     * @return string The path to the watermarked image file.
     */
    public function addWatermark($filepath, $watermarkPath)
    {
        $image = \Config\Services::image()
            ->withFile($filepath)
            ->watermark($watermarkPath)
            ->save($filepath);

            return $filepath;
    }

    /**
     * Converts an image to AVIF format.
     *
     * This method takes the file path of an image, converts it to AVIF format,
     * and saves the converted image back to the same file path. It also ensures
     * that the alpha channel of the original image is preserved, if it exists.
     *
     * @param string $filepath The file path of the image to be converted.
     * @return string The file path of the converted image.
     */
    public function convertToAvif($filepath)
    {
        $image = \Config\Services::image()
            ->withFile($filepath)
            ->convert(IMAGETYPE_AVIF, 100, true) // Preserve alpha channel
            ->save($filepath);

        return $filepath;
    }
}