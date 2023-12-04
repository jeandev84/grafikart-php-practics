<?php
declare(strict_types=1);

namespace Grafikart\Security\Encoder;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @PasswordEncoderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Encoder
 */
interface PasswordEncoderInterface
{
     public function encodePassword(string $plainPassword, string $salt = null): string;

     public function isPasswordValid(string $plainPassword, string $hashPassword): bool;
}