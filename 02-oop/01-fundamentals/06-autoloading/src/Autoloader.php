<?php
declare(strict_types=1);


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
         require_once "src/$class.php";
     }
}