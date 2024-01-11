<?php
declare(strict_types=1);

namespace App\Blog\Repository;


use App\Blog\Entity\Category;
use Framework\Database\ORM\EntityRepository;
use PDO;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CategoryRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Repository
 */
class CategoryRepository extends EntityRepository
{
      public function __construct(PDO $connection)
      {
          parent::__construct($connection, Category::class, 'categories');
      }
}