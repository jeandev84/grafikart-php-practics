<?php

$emitter = \Grafikart\Event\Dispatcher\Emitter::getInstance();
$emitter->emit('Comment.created', $comment);
$emitter->emit('User.new', $user);


$emitter->on('Comment.created', function ($comment) {
    return $comment->createdMessage();
});


$emitter->on('User.new', function ($user) {
    return mail('...');
});