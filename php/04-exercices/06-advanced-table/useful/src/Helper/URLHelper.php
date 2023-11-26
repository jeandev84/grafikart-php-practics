<?php
declare(strict_types=1);

namespace App\Helper;


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
          return http_build_query(array_merge($data, $params));
     }


     public static function withParam(array $data, string $param, $value): string
     {
         return static::withParams($data, [$param => $value]);
     }
}