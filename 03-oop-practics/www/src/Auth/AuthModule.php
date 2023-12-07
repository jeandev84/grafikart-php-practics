<?php
declare(strict_types=1);

namespace App\Auth;


use Framework\Module;
use Psr\Container\ContainerInterface;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @AuthModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth
*/
class AuthModule extends Module
{

      const DEFINITIONS = __DIR__.'/config.php';
      const MIGRATIONS = __DIR__.'/db/migrations';
      const SEEDS =  __DIR__.'/db/seeds';


      /**
       * @var ContainerInterface
      */
      protected ContainerInterface $container;


      /**
       * @param ContainerInterface $container
      */
      public function __construct(ContainerInterface $container)
      {
          $this->container = $container;
      }
}