<?php

use App\Admin\Actions\DashboardAction;
use App\Admin\AdminModule;
use function DI\get;
use function DI\object;

return [
  'admin.prefix' => '/admin',
  'admin.widgets' => [],
  AdminModule::class => object()->constructorParameter('prefix', get('admin.prefix')),
  DashboardAction::class => object()->constructorParameter('widgets', get('admin.widgets'))
];