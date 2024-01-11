<?php
declare(strict_types=1);


namespace App\Admin\Widgets;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @AdminWidgetInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin\Widgets
 */
interface AdminWidgetInterface
{
     public function render(): string;

     public function renderMenu(): string;
}