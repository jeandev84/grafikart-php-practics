<?php
declare(strict_types=1);

namespace Framework\Twig;


use Framework\Middleware\CsrfMiddleware;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @CsrfExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Twig
 */
class CsrfExtension extends AbstractExtension
{

      /**
       * @var CsrfMiddleware
      */
      protected CsrfMiddleware $csrfMiddleware;


      /**
       * @param CsrfMiddleware $csrfMiddleware
      */
      public function __construct(CsrfMiddleware $csrfMiddleware)
      {
          $this->csrfMiddleware = $csrfMiddleware;
      }


      public function getFunctions(): array
      {
          return [
              new TwigFunction('csrf_input', [$this, 'csrfInput'])
          ];
      }



      public function csrfInput()
      {
          return sprintf('<input type="hidden" name="" value=""/>');
      }
}