<?php
declare(strict_types=1);

namespace App\Helpers;


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

         $value = $request->queries->get($name, $default);

         if (! filter_var($value, FILTER_VALIDATE_INT)) {
            throw new \Exception("Le parametre '$name' n'est pas un entier.");
         }

         return (int)$value;
     }
}