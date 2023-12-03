<?php

$manager = new \Grafikart\Events\EventManager();

$manager->attach('database.delete.post', function ($event) {
     Images::delete($event->getTarget()->getImages());
});


$manager->trigger(new DeletePostEvent($post));