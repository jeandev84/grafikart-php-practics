<?php
declare(strict_types=1);

namespace Grafikart\Event\Attributes;

use Attribute;

/**
 * EventListener
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Event\Attributes
 */
#[Attribute]
class EventListener
{
    public function __construct(
        protected string $eventName
    )
    {
    }
}