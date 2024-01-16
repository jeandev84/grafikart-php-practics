<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence;

use Grafikart\Database\ORM\Mapping\ClassMetadata;
use Grafikart\Database\ORM\Query\QueryBuilder;

/**
 * Persistent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Persistence
 */
class Persistent
{
      /**
       * @var ClassMetadata
      */
      protected ClassMetadata $metadata;


      public function __construct(ClassMetadata $metadata)
      {
      }



      public function find(int $id): mixed
      {

      }
}