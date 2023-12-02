<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\Category;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @CategoryRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class CategoryRepository extends ServiceRepository
{

      protected string $tableName = 'categories';

      public function __construct(PdoConnection $connection)
      {
          parent::__construct($connection, Category::class);
      }
}