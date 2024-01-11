<?php
declare(strict_types=1);

namespace App\Security;


use App\Repository\UserRepository;
use Grafikart\Security\Provider\UserProviderInterface;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @UserProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Security
 */
class UserProvider implements UserProviderInterface
{


    public function __construct(protected UserRepository $userRepository)
    {
    }



    public function loadByUsername(string $username): ?UserInterface
    {
         return $this->userRepository->findByUsername($username);
    }
}