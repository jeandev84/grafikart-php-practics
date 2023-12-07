<?php
declare(strict_types=1);

namespace Framework\Twig;


use Framework\Session\FlashService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @FlashExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Twig
 */
class FlashExtension extends AbstractExtension
{


      /**
        * @var FlashService
       */
       protected FlashService $flashService;


       /**
        * @param FlashService $flashService
       */
       public function __construct(FlashService $flashService)
       {
           $this->flashService = $flashService;
       }


       public function getFunctions()
       {
           return [
               new TwigFunction('flash', [$this, 'getFlash'])
           ];
       }


       /**
        * @param string $type
        * @return string|null
       */
       public function getFlash(string $type): ?string
       {
           return $this->flashService->get($type);
       }
}