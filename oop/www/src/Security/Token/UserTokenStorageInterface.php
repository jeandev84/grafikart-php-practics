<?php
declare(strict_types=1);

namespace Grafikart\Security\Token;


use App\Security\UserTokenStorage;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserTokenStorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Token
 */
interface UserTokenStorageInterface
{

       public function setToken(UserInterface $user): UserTokenInterface;


       public function getToken(): UserTokenInterface;


       public function hasToken(): bool;



       public function setRememberMeToken(UserInterface $user);


       public function removeToken(UserInterface $user): mixed;


       public function removeRememberMeToken(UserInterface $user);
}