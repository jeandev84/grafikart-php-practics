<?php
declare(strict_types=1);

namespace Framework\Service;


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
     * @param string|null $oldFile
     * @return string
    */
    public function upload(UploadedFileInterface $file, ?string $oldFile = null): string
    {
        $this->delete($oldFile);

        $targetPath = $this->addSuffix($this->path($file->getClientFilename()));
        $dirname    = pathinfo($targetPath, PATHINFO_DIRNAME);
        if (! is_dir($dirname)) {
            mkdir($dirname, 0777, true);
        }

        $file->moveTo($targetPath);
        return pathinfo($targetPath)['basename'];
    }



    private function delete(?string $oldFile): void
    {
        if ($oldFile) {
            $oldPath = $this->path($oldFile);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
    }



    /**
     * @param string $targetPath
     * @return string
    */
    public function addSuffix(string $targetPath): string
    {
         if (file_exists($targetPath)) {
             $info = pathinfo($targetPath);
             $targetPath = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '_copy.'. $info['extension'];
             return $this->addSuffix($targetPath);
         }

         return $targetPath;
    }



    public function path(string $filename): string
    {
        return $this->path. DIRECTORY_SEPARATOR. $filename;
    }
}