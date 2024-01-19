<?php
declare(strict_types=1);

namespace Grafikart\Routing\Attributes;

use Attribute;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Routing\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD|Attribute::TARGET_CLASS)]
##[Attribute(Attribute::TARGET_METHOD|Attribute::TARGET_CLASS)]
##[Attribute(Attribute::TARGET_ALL)]
class Route
{
     public function __construct(
         private string $path,
         private array $methods = ['GET'],
         private string $name = '',
         private array $requirements = []
     )
     {
     }


    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * @return string
     */
    public function getMethods(): string
    {
        return join('|', $this->methods);
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return array
    */
    public function getRequirements(): array
    {
        return $this->requirements;
    }
}