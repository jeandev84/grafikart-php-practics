<?php
declare(strict_types=1);

namespace App\Service\Upload;

use Grafikart\Http\Request\Exception\UploadedFileException;
use Grafikart\Http\Request\UploadedFile;

/**
 * FileUploader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Service\Upload
 */
class FileUploader
{

      /**
       * @var string
      */
      protected string $uploadDir;



      /**
       * @var string
      */
      protected string $filename;



      /**
       * @var array
      */
      protected array $allowedExtensions = ['jpg', 'png'];


      /**
       * @param string $uploadDir
      */
      public function __construct(string $uploadDir)
      {
          $this->uploadDir = $uploadDir;
      }




      /**
       * @param string $path
       * @return string
      */
      public function targetPath(string $path): string
      {
          return $this->uploadDir . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
      }




    /**
     * @param array $extensions
     * @return $this
     */
    public function withAllowedExtensions(array $extensions): static
    {
        $this->allowedExtensions = $extensions;

        return $this;
    }




    /**
     * @return array
     */
    public function getAllowedExtensions(): array
    {
        return $this->allowedExtensions;
    }





    /**
     * @return bool
     */
    public function hasAllowedExtensions(): bool
    {
        return !empty($this->allowedExtensions);
    }





    /**
     * @param string $extension
     * @return bool
    */
    public function hasValidExtension(string $extension): bool
    {
        return in_array($extension, $this->allowedExtensions);
    }






    /**
     * @return string
     */
    public function getExtensionsAsString(): string
    {
        return '('. join(', ', $this->allowedExtensions) . ')';
    }




    /**
     * @param string $filename
     * @return $this
    */
    public function withFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }



    /**
     * @param UploadedFile $file
     * @return mixed
     * @throws UploadedFileException
     */
      public function upload(UploadedFile $file): mixed
      {
          if (! $this->filename) {
              $this->filename = md5(uniqid()) . '_'. $file->getClientExtension();
          }

          $file->moveTo($path = $this->targetPath($this->filename));

          return $path;
      }





      /**
       * @param string $file
       * @return bool
      */
      public function remove(string $file): bool
      {
          $path = $this->targetPath($file);

          if (! file_exists($path)) {
              return false;
          }

          return unlink($path);
      }


      /**
       * @param string $pattern
       * @return array
      */
      public function getImages(string $pattern): array
      {
          return glob($this->targetPath($pattern)) ?? [];
      }




      /**
       * @param array $images
       * @return void
      */
      public function removeImages(array $images): void
      {
           foreach ($images as $image) {
               unlink($image);
           }
      }




     /**
      * @param string $filename
      * @return void
     */
     public function removeResizedImages(string $filename): void
     {
          $resizedImages = $this->getImages($filename . '_*x*.*');

          $this->removeImages($resizedImages);
     }



      /*
      private function isallowed(string $name, $extension): bool
      {
          if ($this->hasAllowedExtensions() && !$this->hasValidExtension($extension)) {
              throw new UploadedFileException("file $name not allowed extensions : ". $this->getExtensionsAsString());
          }

          return true;
      }
      */
}