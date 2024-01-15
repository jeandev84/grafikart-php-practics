<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Work;
use App\Uploader\WorkFileUploader;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;
use Grafikart\Http\Request\Exception\UploadedFileException;
use Grafikart\Http\Request\UploadedFile;
use Grafikart\Service\Image\ImageService;

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
      * @var string
     */
     protected string $uploadDir;


     /**
      * @param PdoConnection $connection
      * @param string $uploadDir
     */
     public function __construct(PdoConnection $connection, string $uploadDir = '')
     {
          parent::__construct($connection, Work::class, 'works');
          $this->imageRepository  = new ImageRepository($connection);
          $this->workFileUploader = new WorkFileUploader($uploadDir);
          $this->uploadDir = $uploadDir;
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

         # Save Image info in database
         $imageId = $this->imageRepository->create([
             "name"    => $file->getClientFilename(),
             "work_id" => $work->getId()
         ]);

         # Upload Image
         $extension = $file->getClientExtension();
         $imageName = "{$imageId}.$extension";
         $path      = "works/$imageName";

         $this->workFileUploader->withFilename($path)->upload($file);

         # Resize Image
         $image = new ImageService($this->uploadDir . "/$path");
         $image->resize(150, 150);
         #$image->save();

         # Update Image info table
         return $this->imageRepository->update(["name" => $imageName], $imageId);
     }


     /**
      * @param int $imageId
      * @return bool
     */
     public function removeImage(int $imageId): bool
     {
          /** @var Image $image */
          if (!$image = $this->imageRepository->find($imageId)) {
              return false;
          }

          # Remove file from database
          $this->imageRepository->delete($imageId);

          # Remove from disk
          $this->workFileUploader->remove("works/{$image->getName()}");

          # remove resized file
          /*
           $resizedFiles = glob("$this->uploadDir/works/". pathinfo($image->getName(), PATHINFO_FILENAME) . '_*x*.*');

           if (is_array($resizedFiles)) {
             $this->workFileUploader->removeImages($resizedFiles);
           }
          */
          $this->workFileUploader->removeResizedImages("works/". pathinfo($image->getName(), PATHINFO_FILENAME));

          return true;
     }


    /**
     * @param int $workId
     * @param int $imageId
     * @return bool
     */
     public function highlightImage(int $workId, int $imageId): bool
     {
         /** @var Image $image */
         if (!$this->imageRepository->find($imageId)) {
             return false;
         }

         return $this->update(['image_id' => $imageId], $workId);
     }


     /**
      * @return array
     */
     public function findPortfolioWorks(): array
     {
         $sql = 'SELECT w.name, w.id, w.slug, i.name as image_name
                 FROM works w
                 LEFT JOIN images i ON i.id = w.image_id';
         $statement  = $this->connection->statement($sql, $this->className);
         $statement->execute();
         return $statement->fetchAll();
     }


     /**
      * @param $slug
      * @return Work|false
     */
     public function findBySlug($slug): mixed
     {
          return $this->findOneBy(compact('slug'));
     }
}