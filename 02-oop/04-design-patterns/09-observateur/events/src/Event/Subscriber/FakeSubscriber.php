<?php
declare(strict_types=1);

namespace Grafikart\Event\Subscriber;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @FakeSubscriber
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Event\Subscriber
 */
class FakeSubscriber implements SubscriberInterface
{

    public function getEvents(): array
    {
        return  [
            'Comment.created' => 'onNewComment',
            'Post.created'    => 'onNewPost',
            #'User.created'    => ['onSendEmail', 200, ['stopPropagation' => true]]
        ];
    }
}