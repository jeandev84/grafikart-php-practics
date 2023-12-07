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


    public function upload(UploadedFileInterface $file): string
    {
        $filename   = $file->getClientFilename();
        $targetPath = $this->addSuffix($this->path. DIRECTORY_SEPARATOR. $filename);
        $file->moveTo($targetPath);
        return pathinfo($targetPath)['basename'];
    }




    public function addSuffix(string $targetPath): string
    {
         if (file_exists($targetPath)) {
             $info = pathinfo($targetPath);
             $targetPath = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '_copy'. $info['extension'];
             return $this->addSuffix($targetPath);
         }

         return $targetPath;
    }


    public function path(string $filename): string
    {

    }
}