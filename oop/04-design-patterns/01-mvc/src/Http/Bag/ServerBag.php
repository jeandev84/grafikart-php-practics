<?php
declare(strict_types=1);

namespace Grafikart\Http\Bag;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @ServerBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Bag
 */
class ServerBag extends ParameterBag
{
       public function getMethod(): string
       {
            return $this->get('REQUEST_METHOD', 'GET');
       }



       public function getRequestUri(): string
       {
            return $this->get('REQUEST_URI');
       }
}