<?php
declare(strict_types=1);

namespace App\Security;


use App\Repository\UserRepository;
use Grafikart\Security\Provider\UserProviderInterface;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Security\Provider
 */
class UserProvider implements UserProviderInterface
{

    protected UserRepository $repository;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function loadByUsername(string $username): ?UserInterface
    {
        return $this->repository->findByUsername($username);
    }
}