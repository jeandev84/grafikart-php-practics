<?php
declare(strict_types=1);

namespace Grafikart\Security\Encoder;


use App\Entity\User;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserPasswordEncoderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Encoder
 */
interface UserPasswordEncoderInterface
{
    public function encodePassword(UserInterface $user, string $plainPassword): string;

    public function isPasswordValid(UserInterface $user, string $plainPassword): bool;
}