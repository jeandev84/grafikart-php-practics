<?php
declare(strict_types=1);

namespace App;



/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Autoloader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package ${NAMESPACE}
 */
class Autoloader
{
     public static function register(): void
     {
         spl_autoload_register([__CLASS__, 'loadClass']);
     }


     protected static function loadClass(string $class): void
     {
         $namespace = __NAMESPACE__."\\";
         if (stripos($class, $namespace) === 0) {
             $class = str_replace([$namespace, '\\'], ['', '/'], $class);
             require_once __DIR__."/$class.php";
         }
     }
}