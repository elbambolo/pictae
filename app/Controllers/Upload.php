<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

/**
 * Class Upload
 *
 * This class is responsible for handling the image upload process.
 * It validates the uploaded image file(s) based on the specified rules,
 * processes the upload, and stores the file(s) in the designated directory.
 * If the validation fails or no files are uploaded, it redirects back with an error message.
 * On successful upload, it returns a view with the uploaded file information.
 *
 * @package App\Controllers
 *
 * Flow of the Upload class:
 * 1. getIndex() - Displays the upload view.
 * 2. postUploadImage() - Handles the image upload process.
 * 3. resizeImage() - Resizes the given image to the specified width and height.
 * 4. createThumbnail() - Creates a thumbnail of the specified image.
 * 5. cropImage() - Crops an image to the specified dimensions and saves it. Opional!!!
 * 6. rotateImage() - Rotates an image by a specified angle and saves the rotated image.
 * 7. addWatermark() - Adds a watermark to an image.
 * 8. convertToAvif() - Converts an image to AVIF format.
 */


class Upload extends BaseController
{
    /**
     * Displays the upload view.
     *
     * This method handles the GET request to the index route and returns
     * the 'upload' view to the user.
     *
     * @return \CodeIgniter\View\View The upload view.
     */
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
            /**
             * Redirects the user back to the previous page with an error message.
             *
             * This function uses the `redirect()->back()` method to send the user back to the previous page.
             * It also attaches an error message indicating that no file was selected for upload.
             * The error message is retrieved using the `lang()` function, which fetches the appropriate
             * language string based on the current language settings of the application.
             *
             * @return \CodeIgniter\HTTP\RedirectResponse The redirect response object.
             */
            return redirect()->back()->with('error', lang('upload.no_file_selected'));
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

    /**
     * Reads the EXIF data from the given file.
     *
     * @param string $file The path to the file from which to read the EXIF data.
     * @return array|false The EXIF data as an associative array, or false if no data is found or the file is not readable.
     */
    private function leggiExif($file)
    {
        $exif = exif_read_data($file);
        return $exif;
    }
}