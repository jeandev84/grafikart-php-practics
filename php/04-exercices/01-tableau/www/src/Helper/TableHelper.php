<?php
declare(strict_types=1);

namespace App\Helper;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @TableHelper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helper
 */
class TableHelper
{

    const SORT_KEY = 'sort';
    const DIR_KEY = 'dir';

     public static function sort(string $sortKey, string $label, array $data): string
     {
         $sort      = $data[self::SORT_KEY] ?? null;
         $direction = $data[self::DIR_KEY] ?? null;
         $icon      = "";
         if ($sort === $sortKey) {
            $icon = ($direction === 'asc' ? "^" : "v");
         }

         $url = URLHelper::withParams($data, [
             'sort' => $sortKey,
             'dir' => ($direction === 'asc' && $sort === $sortKey) ? 'desc' : 'asc'
         ]);

         return sprintf('<a href="?%s">%s %s</a>', $url, $label, $icon);
     }
}