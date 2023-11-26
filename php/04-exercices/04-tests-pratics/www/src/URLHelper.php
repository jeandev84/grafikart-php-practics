<?php
declare(strict_types=1);

namespace App;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @UrlHelper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helper
 */
class URLHelper
{
     public static function withParams(array $data, array $params): string
     {
          /*
          foreach ($params as $k => $v) {
               if (is_array($v)) {
                   $params[$k] = implode(",", $v);
               }
          }
          */

          $params = array_map(function ($v) {
              return is_array($v) ? implode(",", $v) : $v;
          }, $params);

          return http_build_query(array_merge($data, $params));
     }


     public static function withParam(array $data, string $param, $value): string
     {
         if (is_array($value)) {
             $value = implode(",", $value);
         }

         return static::withParams($data, [$param => $value]);
     }
}