<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Repository;

use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Mapping\ClassMetadata;

/**
 * ServiceRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Repository
 */
class ServiceRepository extends EntityRepository
{

     /**
      * @param PdoConnection $connection
      * @param string $entity
      * @throws \ReflectionException
     */
     public function __construct(PdoConnection $connection, string $entity)
     {
         parent::__construct($connection, new ClassMetadata($entity));
     }
}