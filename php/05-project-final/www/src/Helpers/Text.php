<?php
declare(strict_types=1);

namespace Grafikart\Helpers;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Text
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Helpers
 */
class Text
{
     public static function excerpt(string $content, int $limit = 60): string
     {
         if (mb_strlen($content) <= $limit) {
              return $content;
         }

         # return substr($content, 0, $limit). '...';

         $lastSpace = mb_strpos($content, ' ', $limit);
         return mb_substr($content, 0, $lastSpace). '...';
     }
}