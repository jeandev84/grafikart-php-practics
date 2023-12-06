<?php

use App\Blog\BlogModule;
use function DI\get;
use function DI\object;

return [
    'blog.prefix' => '/blog',
    'admin.widgets' => \DI\add([
        get(\App\Blog\BlogWidget::class)
    ])
];