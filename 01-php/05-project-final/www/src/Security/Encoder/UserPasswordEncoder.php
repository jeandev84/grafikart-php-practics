<?php
declare(strict_types=1);

namespace Grafikart\Security\Encoder;


use App\Entity\User;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserPasswordEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Encoder
 */
class UserPasswordEncoder implements UserPasswordEncoderInterface
{

    protected PasswordEncoder $encoder;


    public function __construct()
    {
        $this->encoder = new PasswordEncoder();
    }


    public function encodePassword(UserInterface $user, string $plainPassword): string
    {
        return $this->encoder->encodePassword($plainPassword, $user->getSalt());
    }


    public function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
         return $this->encoder->isPasswordValid($plainPassword, $user->getPassword());
    }
}