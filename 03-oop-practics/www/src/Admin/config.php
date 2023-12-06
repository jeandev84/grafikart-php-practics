<?php

use App\Admin\Actions\DashboardAction;
use App\Admin\AdminModule;
use App\Admin\Extensions\AdminTwigExtension;
use function DI\get;
use function DI\object;

return [
  'admin.prefix'    => '/admin',
  'admin.widgets'   => [],
  AdminTwigExtension::class => object()->constructor(get('admin.widgets')),
  AdminModule::class => object()->constructorParameter('prefix', get('admin.prefix')),
  DashboardAction::class => object()->constructorParameter('widgets', get('admin.widgets'))
];