<?php
declare(strict_types=1);

namespace App\Admin\Extensions;


use App\Admin\Widgets\AdminWidgetInterface;
use Framework\Templating\Renderer\RendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @AdminTwigExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin\Extensions
 */
class AdminTwigExtension extends AbstractExtension
{

      /**
       * @var AdminWidgetInterface[]
      */
      protected array $widgets = [];


      /**
       * @param array $widgets
      */
      public function __construct(array $widgets)
      {
          $this->widgets = $widgets;
      }



      /**
       * @return TwigFunction[]
      */
      public function getFunctions(): array
      {
          return [
              new TwigFunction('admin_menu', [$this, 'renderMenu'], ['is_safe' => ['html']])
          ];
      }



      public function renderMenu(): string
      {
          return array_reduce($this->widgets, function (string $html, AdminWidgetInterface $widget) {
              return $html . $widget->renderMenu();
          }, '');
      }
}