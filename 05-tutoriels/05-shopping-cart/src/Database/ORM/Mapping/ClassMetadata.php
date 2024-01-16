<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Mapping;

use ReflectionClass;
use ReflectionException;

/**
 * ClassMetadata
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Mapping
 */
class ClassMetadata
{

     /**
      * @var ReflectionClass
     */
     protected ReflectionClass $reflection;



     /**
      * @var string
     */
     protected string $identityName = 'id';



     /**
      * @param $class
      * @throws ReflectionException
     */
     public function __construct($class)
     {
         $this->reflection = new ReflectionClass($class);
     }





     /**
      * @return ReflectionClass
     */
     public function getReflection(): ReflectionClass
     {
         return $this->reflection;
     }




     /**
      * @return string
     */
     public function getClassName(): string
     {
         return $this->reflection->getName();
     }





     /**
      * @return string
     */
     public function getTableName(): string
     {
         $shortName = $this->reflection->getShortName();

         return mb_strtolower("{$shortName}s");
     }




     /**
      * @return string
     */
     public function getTableAlias(): string
     {
         return $this->getTableName()[0] ?? '';
     }





    /**
     * @return string
    */
    public function getIdentityName(): string
    {
        return $this->identityName;
    }
}