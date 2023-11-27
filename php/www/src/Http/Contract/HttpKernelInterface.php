<?php
declare(strict_types=1);

namespace Grafikart\Http\Contract;


use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @HttpKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Contract
 */
interface HttpKernelInterface
{
     public function handle(Request $request): Response;
}