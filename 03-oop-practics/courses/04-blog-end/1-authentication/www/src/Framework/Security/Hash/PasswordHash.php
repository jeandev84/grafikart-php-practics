<?php
declare(strict_types=1);

namespace Framework\Security\Hash;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @PasswordHash
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Security\Hash
 */
class PasswordHash
{


     /**
      * @param string $password
      *
      * @return string
     */
     public static function hash(string $password): string
     {
         return password_hash($password, PASSWORD_DEFAULT);
     }



     /**
      * @param string $password
      *
      * @param string $hash
      *
      * @return bool
     */
     public static function match(string $password, string $hash): bool
     {
           return password_verify($password, $hash);
     }
}