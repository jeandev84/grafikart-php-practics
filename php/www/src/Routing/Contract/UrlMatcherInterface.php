<?php
declare(strict_types=1);

namespace Grafikart\Routing\Contract;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @UrlMatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing\Contract
 */
interface UrlMatcherInterface
{
      public function match(): mixed;
}