<?php
declare(strict_types=1);

namespace App\Admin\Actions;


use App\Admin\AdminWidgetInterface;
use Framework\Templating\Renderer\RendererInterface;
use Grafikart\Http\Request\Request;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @DashboardAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin\Actions
 */
class DashboardAction
{

     /**
      * @var RendererInterface
     */
     protected RendererInterface $renderer;


     /**
      * @var AdminWidgetInterface[]
     */
     protected array $widgets = [];

     public function __construct(RendererInterface $renderer, array $widgets)
     {
         $this->renderer = $renderer;
         $this->widgets  = $widgets;
     }



     public function __invoke(): mixed
     {
         $widgets = array_reduce($this->widgets, function (string $html, AdminWidgetInterface $widget) {
             return $html . $widget->render();
         }, '');

         return $this->renderer->render("@admin/dashboard", compact('widgets'));
     }
}