<?php

use function DI\get;

return [
    'blog.prefix' => '/blog',
    'admin.widgets' => \DI\add([
        get(\App\Blog\Widgets\BlogWidget::class)
    ])
];