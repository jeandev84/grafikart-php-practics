<?php
declare(strict_types=1);

namespace Grafikart\Security\Token;


use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserTokenInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Token
 */
interface UserTokenInterface
{
     public function getUser(): UserInterface;
}