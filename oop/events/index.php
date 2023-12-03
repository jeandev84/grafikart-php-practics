<?php

require 'vendor/autoload.php';

$emitter = \Grafikart\Event\Emitter::getInstance();

$emitter->once('Comment.created', function ($firstname, $lastname) {
    echo "$firstname $lastname a poste un nouveau commentaire\n";
}, 1); // lancer evenement une seule fois
$emitter->on('Comment.created', function ($firstname, $lastname) {
   echo "$firstname $lastname a poste un nouveau commentaire\n";
}, 1); // lancer en second
$emitter->on('Comment.created', function ($firstname, $lastname) {
    echo "$firstname $lastname a poste un nouveau commentaire\n";
}, 100); // lancer en premier

$emitter->emit('Comment.created', 'John', 'Doe');
$emitter->emit('User.new');

