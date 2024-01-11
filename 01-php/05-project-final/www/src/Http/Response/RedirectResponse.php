<?php
declare(strict_types=1);

namespace Grafikart\Http\Response;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @RedirectResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Response
 */
class RedirectResponse extends Response
{
     public function __construct(?string $path, ?int $status = 302)
     {
         parent::__construct('', $status, ['Location' => $path]);
     }
}