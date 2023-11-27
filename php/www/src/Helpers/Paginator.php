<?php
declare(strict_types=1);

namespace Grafikart\Helpers;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Paginator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Helpers
 */
class Paginator
{
     protected array $items = [];


     public function __construct(array $items)
     {
         $this->items = $items;
     }


     public function paginate(int $page, int $limit)
     {

     }
}