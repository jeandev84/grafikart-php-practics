<?php
declare(strict_types=1);

namespace App\Service\Upload;

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
          return $this->uploadDir . DIRECTORY_SEPARATOR . $path;
      }




      /**
       * @param UploadedFile $file
       * @param string|null $filename
       * @return void
      */
      public function uploadFileFromRequest(UploadedFile $file, string $filename = null)
      {
          try {


          }catch (\Throwable $e) {

          }
      }
}