<?php
declare(strict_types=1);

namespace App\Security;


use Grafikart\Security\Exception\ForbiddenException;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @Auth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Security
 */
class Auth
{
     public static function check()
     {
           if (session_status() === PHP_SESSION_NONE) {
               session_start();
           }

           if (! isset($_SESSION['auth'])) {
               throw new ForbiddenException();
           }
     }
}