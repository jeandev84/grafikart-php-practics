<?php
declare(strict_types=1);

namespace Grafikart\Security;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security
 */
interface UserInterface
{
      public function getRoles(): array;

      public function getIdentifier(): mixed;

      public function getSalt(): string;


      public function getPassword(): mixed;
}