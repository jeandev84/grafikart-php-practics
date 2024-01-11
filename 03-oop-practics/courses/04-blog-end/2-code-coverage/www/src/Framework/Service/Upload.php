<?php
declare(strict_types=1);

namespace Framework\Service;


use Intervention\Image\ImageManager;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @Upload
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Service
 */
class Upload
{


    /**
     * @var string
    */
    protected string $path;


    /**
     * @var array
    */
    protected array $formats = [];



    public function __construct(?string $path = null)
    {
        $this->path = $path;
    }


    /**
     * @param UploadedFileInterface $file
     *
     * @param string|null $oldFile
     *
     * @return string|null
    */
    public function upload(UploadedFileInterface $file, ?string $oldFile = null): ?string
    {
          if ($file->getError() === UPLOAD_ERR_OK) {

              $this->delete($oldFile);

              $targetPath = $this->addCopySuffix($this->path($file->getClientFilename()));
              $dirname    = pathinfo($targetPath, PATHINFO_DIRNAME);
              if (! is_dir($dirname)) {
                  mkdir($dirname, 0777, true);
              }

              // Upload file
              $file->moveTo($targetPath);

              // Generate formats (thumb)
              $this->generateFormats($targetPath);

              return pathinfo($targetPath)['basename'];
          }

          return null;
    }



    private function generateFormats(string $targetPath)
    {
         foreach ($this->formats as $format => $size) {
             $manager          = new ImageManager(['driver' => 'gd']);
             $destination      = $this->getPathWithSuffix($targetPath, $format);
             [$width, $height] = $size;

             $manager->make($targetPath)->fit($width, $height)->save($destination);
         }
    }




    /**
     * @param string $path
     *
     * @param string $suffix
     *
     * @return string
    */
    private function getPathWithSuffix(string $path, string $suffix): string
    {
        $info = pathinfo($path);
        return  $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '_'. $suffix . '.'. $info['extension'];
    }




    /**
     * @param string|null $oldFile
     *
     * @return void
    */
    public function delete(?string $oldFile): void
    {
        if ($oldFile) {
            // remove old file
            $oldFile = $this->path($oldFile);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

            // remove resized files
            foreach ($this->formats as $format => $_) {
                $oldFileWithFormat = $this->getPathWithSuffix($oldFile, $format);
                if (file_exists($oldFileWithFormat)) {
                    unlink($oldFileWithFormat);
                }
            }
        }
    }



    /**
     * @param string $targetPath
     * @return string
    */
    private function addCopySuffix(string $targetPath): string
    {
         if (file_exists($targetPath)) {
             return $this->addCopySuffix($this->getPathWithSuffix($targetPath, 'copy'));
         }

         return $targetPath;
    }



    private function path(string $filename): string
    {
        return $this->path. DIRECTORY_SEPARATOR. $filename;
    }
}