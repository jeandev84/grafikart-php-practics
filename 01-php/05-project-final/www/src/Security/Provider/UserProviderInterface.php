<?php
declare(strict_types=1);

namespace Grafikart\Security\Provider;


use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Provider
 */
interface UserProviderInterface
{
     public function loadByUsername(string $username): ?UserInterface;
}