<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;

/**
 * CategoryRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class CategoryRepository extends EntityRepository
{

     /**
      * @param PdoConnection $connection
     */
     public function __construct(PdoConnection $connection)
     {
         parent::__construct($connection, Category::class, 'categories');
     }




     /**
      * @param int $id
      * @return Category
      * @throws Exception
     */
     public function findCategory(int $id): Category
     {
         if (! $category = $this->find($id)) {
              throw new Exception("Could not found record category#$id");
         }

         return $category;
     }




     /**
      * @return array
     */
     public function getCategoryList(): array
     {
           $sql = "SELECT id, name FROM $this->tableName ORDER BY name ASC";
           $statement = $this->connection->statement($sql, $this->className);
           $statement->execute();
           $categories = $statement->fetchAll();
           $categoryList = [];

           foreach ($categories as $category) {
               $categoryList[$category->getId()] = $category->getName();
           }

           return $categoryList;
     }
}