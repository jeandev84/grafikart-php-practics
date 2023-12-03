<?php

require 'vendor/autoload.php';

$emitter = \Grafikart\Event\Emitter::getInstance();
$emitter->emit('Comment.created', function ($firstname, $lastname) {
   echo "$firstname $lastname a poste un nouveau commentaire\n";
});
$emitter->emit('User.new');


$emitter->on('Comment.created', function ($comment) {
     return $comment->createdMessage();
});


$emitter->on('User.new', function ($user) {
    return mail('...');
});

