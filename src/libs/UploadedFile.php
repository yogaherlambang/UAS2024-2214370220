<?php

namespace App\Library;

class UploadedFile
{
    /**
     * Moves an uploaded file to directory
     *
     * @param string $directory
     * @param \Slim\Http\UploadedFile $uploadedFile
     * 
     * @return  string $filename
     */
    public static function move(string $directory, \Slim\Http\UploadedFile $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = self::generateHexName(8);
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }

    /**
     * Generate hex name for files
     *
     * @param integer $len
     * @return string 
     */
    public static function generateHexName(int $len): string
    {
        return bin2hex(random_bytes($len));
    }
}
