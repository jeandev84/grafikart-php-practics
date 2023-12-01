<?php
declare(strict_types=1);

namespace Grafikart\Http;


use Grafikart\Http\Contract\HttpKernelInterface;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @HttpKernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http
 */
abstract class HttpKernel implements HttpKernelInterface
{
      abstract public function getProjectDir(): string;
}