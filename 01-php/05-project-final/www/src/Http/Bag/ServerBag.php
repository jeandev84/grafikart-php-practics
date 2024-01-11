<?php
declare(strict_types=1);

namespace Grafikart\Http\Bag;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @ServerBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Bag
 */
class ServerBag extends ParameterBag
{
       public function generateUrl(): string
       {
           return '';
       }
}