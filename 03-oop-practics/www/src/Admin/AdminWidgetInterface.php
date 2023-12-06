<?php
declare(strict_types=1);

namespace App\Admin;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @AdminWidgetInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin
 */
interface AdminWidgetInterface
{
     public function render(): string;
}