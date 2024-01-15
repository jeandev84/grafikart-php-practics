<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Image;
use App\Entity\Work;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;

/**
 * ImageRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class ImageRepository extends EntityRepository
{

     /**
      * @param PdoConnection $connection
     */
     public function __construct(PdoConnection $connection)
     {
         parent::__construct($connection, Image::class, 'images');
     }



     /**
      * @param int $workId
      * @return array
     */
     public function getWorkImages(int $workId): array
     {
         $sql = "SELECT id, name FROM $this->tableName WHERE work_id = :workId";
         $statement = $this->connection->statement($sql, $this->className);
         $statement->execute(compact('workId'));
         return $statement->fetchAll();
     }
}