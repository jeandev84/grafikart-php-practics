<?php
declare(strict_types=1);

namespace App\Auth\Security;


use App\Auth\Repository\UserRepository;
use Framework\Security\Auth;
use Framework\Security\User\UserInterface;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @DatabaseAuth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Security
 */
class DatabaseAuth implements Auth
{

    /**
     * @var UserRepository
    */
    protected UserRepository $userRepository;



    /**
     * @param UserRepository $userRepository
    */
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }




    /**
     * @param string $username
     *
     * @param string $password
     *
     * @return UserInterface|null
    */
    public function login(string $username, string $password): ?UserInterface
    {
          if (empty($username) || empty($password)) {
              return null;
          }

          $user = $this->userRepository->findByUsername($username);

          if (! $user) {
               return null;
          }

          return $user;
    }




    /**
     * @inheritDoc
    */
    public function getUser(): ?UserInterface
    {
        return null;
    }
}