<?php
declare(strict_types=1);

namespace App\Auth\Extensions;


use Framework\Security\Auth;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @AuthTwigExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Extensions
 */
class AuthTwigExtension extends AbstractExtension
{


      /**
       * @var Auth
      */
      protected Auth $auth;


      public function __construct(Auth $auth)
      {
          $this->auth = $auth;
      }




      /**
       * @return array
      */
      public function getFunctions()
      {
          return [
              new TwigFunction('current_user', [$this->auth, 'getUser'])
          ];
      }




}