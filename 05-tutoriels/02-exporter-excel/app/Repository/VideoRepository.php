<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Video;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;

/**
 * VideoRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class VideoRepository extends EntityRepository
{
      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
          parent::__construct($connection, Video::class, 'videos');
      }



      /**
       * @return Video[]
      */
      public function findVideos(): array
      {
          $sql = "SELECT id, title, duration FROM $this->tableName";
          $statement = $this->connection->statement($sql, [], $this->className);
          return $statement->fetchAll();
      }




      /**
       * @return array
      */
      public function findVideosToExport(): array
      {
           $data = [];

           foreach ($this->findVideos() as $video) {
               $data[] = [
                  'ID'    => $video->getId(),
                  'Titre' => $video->getTitle(),
                  'Duree' => $video->getDuration()
               ];
           }

           return $data;
      }



    /**
     * @return array
     */
    public function findVideosToExportWithAliases(): array
    {
        $sql = "SELECT id as ID, title as Titre, duration as Duree FROM $this->tableName";
        $statement = $this->connection->statement($sql);
        return $statement->fetchAll();
    }
}