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
      * @return array
     */
     public function getImages(): array
     {
         $sql = "SELECT id, name FROM $this->tableName";
         $statement = $this->connection->statement($sql, $this->className);
         $statement->execute();
         return $statement->fetchAll();
     }
}