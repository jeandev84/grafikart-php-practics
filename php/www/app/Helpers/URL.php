<?php
declare(strict_types=1);

namespace App\Helpers;


use Exception;
use Grafikart\Http\Request\Request;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @URL
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helpers
 */
class URL
{

     public static function getInt(string $name, ?int $default = null): ?int
     {
         $request = Request::createFromGlobals();

         if (! $request->queries->has($name)) { return $default;}
         if ($request->queries->equalTo($name, '0')) { return 0; }

         $value = $request->queries->get($name);

         if (! filter_var($value, FILTER_VALIDATE_INT)) {
            throw new \Exception("Le parametre '$name' dans l'url n'est pas un entier.");
         }

         return (int)$value;
     }



     public static function getPositiveInt(string $name, ?int $default = null): ?int
     {
          $value = self::getInt($name, $default);

          if ($value !== null && $value <= 0) {
              throw new \Exception("Le parametre '$name' dans l'url n'est pas un entier positif.");
          }

          return $value;
     }
}