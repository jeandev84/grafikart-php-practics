<?php

use App\Events\DeletePostEvent;

$manager = new \Grafikart\Events\EventManager();

$manager->attach('database.delete.post', function (DeletePostEvent $event) {
     unlink($event->getTarget()->getImage());
});


$post = new \App\Entity\Post();
$manager->trigger(new DeletePostEvent($post));