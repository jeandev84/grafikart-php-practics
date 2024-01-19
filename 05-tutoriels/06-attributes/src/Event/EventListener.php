<?php
declare(strict_types=1);

namespace Grafikart\Event;

use Grafikart\Event\Types\onCommentCreatedEvent;

/**
 * EventListener
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Event
 */
class EventListener
{
       #[Attributes\EventListener(onCommentCreatedEvent::class)]
       public function onCommentCreate()
       {

       }
}