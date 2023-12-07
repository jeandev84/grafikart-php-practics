<?php
declare(strict_types=1);

namespace Framework\Security\User;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @UserInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Security\User
 */
interface UserInterface
{

       /**
        * @return string
       */
       public function getUsername(): string;


       /**
        * @return array
       */
       public function getRoles(): array;
}