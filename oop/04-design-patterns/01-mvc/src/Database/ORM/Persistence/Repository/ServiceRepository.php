<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Repository;


use Grafikart\Database\Connection\PdoConnection;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @ServiceRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\ORM\Persistence\Repository
 */
class ServiceRepository extends EntityRepository
{
     public function __construct(PdoConnection $connection, string $classname)
     {
         parent::__construct($connection, $classname);
     }
}