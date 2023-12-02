<?php
declare(strict_types=1);

namespace Grafikart\Security\Encoder;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @PasswordEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Encoder
 */
class PasswordEncoder implements PasswordEncoderInterface
{

    public function encodePassword(string $plainPassword, string $salt = null): string
    {
          return password_hash($plainPassword, PASSWORD_DEFAULT);
    }



    public function isPasswordValid(string $plainPassword, string $hashPassword): bool
    {
        return password_verify($plainPassword, $hashPassword);
    }
}