<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Work;
use App\Uploader\WorkFileUploader;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;
use Grafikart\Http\Request\Exception\UploadedFileException;
use Grafikart\Http\Request\UploadedFile;

/**
 * WorkRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class WorkRepository extends EntityRepository
{

     /**
      * @var ImageRepository
     */
     protected ImageRepository $imageRepository;



     /**
      * @var WorkFileUploader
     */
     protected WorkFileUploader $workFileUploader;


     /**
      * @param PdoConnection $connection
      * @param string $uploadDir
     */
     public function __construct(PdoConnection $connection, string $uploadDir = '')
     {
          parent::__construct($connection, Work::class, 'works');
          $this->imageRepository  = new ImageRepository($connection);
          $this->workFileUploader = new WorkFileUploader($uploadDir);
     }



      /**
       * @param UploadedFile $file
       * @param int $id
       * @return bool
      * @throws UploadedFileException
     */
     public function saveImage(UploadedFile $file, int $id): bool
     {
         /** @var Work $work */
         if (! $work = $this->find($id)) {
             return false;
         }

         $imageId = $this->imageRepository->create([
             "name"    => $file->getClientFilename(),
             "work_id" => $work->getId()
         ]);

         $extension = $file->getClientExtension();
         $imageName = "{$imageId}.$extension";

         $this->workFileUploader->withFilename("works/$imageName")->upload($file);

         return $this->imageRepository->update(["name" => $imageName], $imageId);
     }


     /**
      * @param int $imageId
      * @return bool
     */
     public function removeImage(int $imageId): bool
     {
          $image = $this->imageRepository->find($imageId);
          dd($image);
     }
}