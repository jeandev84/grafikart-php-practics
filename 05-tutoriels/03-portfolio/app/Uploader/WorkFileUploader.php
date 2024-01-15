<?php
declare(strict_types=1);

namespace App\Uploader;

use App\Service\Upload\FileUploader;
use Grafikart\Http\Request\Exception\UploadedFileException;
use Grafikart\Http\Request\UploadedFile;

/**
 * WorkFileUploader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Uploader
 */
class WorkFileUploader extends FileUploader
{
    /**
     * @var array
    */
    protected array $allowedExtensions = ['jpg', 'png'];


    /**
     * @inheritdoc
     */
    public function upload(UploadedFile $file): string
    {
        if (!$this->hasValidExtension($file->getClientExtension())) {
             return '';
        }

        return parent::upload($file);
    }



    /**
     * @param UploadedFile $file
     * @param string $filename
     * @return string
     * @throws UploadedFileException
    */
    public function uploadWorkFile(UploadedFile $file, string $filename): string
    {
          return $this->withFilename("/works/$filename")->upload($file);
    }
}