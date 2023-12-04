<?php
declare(strict_types=1);

namespace Grafikart\Security\Exception;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @ForbiddenException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Exception
 */
class ForbiddenException extends \Exception
{
       public function __construct(string $message = "")
       {
           parent::__construct($message, 403);
       }
}