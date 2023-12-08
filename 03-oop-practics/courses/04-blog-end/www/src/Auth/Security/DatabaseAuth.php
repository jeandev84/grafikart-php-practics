<?php
declare(strict_types=1);

namespace App\Auth\Security;


use App\Auth\Repository\UserRepository;
use Framework\Database\ORM\Exceptions\NoRecordException;
use Framework\Security\Auth;
use Framework\Security\Hash\PasswordHash;
use Framework\Security\User\UserInterface;
use Framework\Session\SessionInterface;


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
     * @var SessionInterface
    */
    protected SessionInterface $session;



    /**
     * @var UserInterface|null
    */
    protected ?UserInterface $user = null;



    /**
     * @var string
    */
    protected string $authKey = 'auth.user';



    /**
     * @param UserRepository $userRepository
     *
     * @param SessionInterface $session
    */
    public function __construct(
        UserRepository $userRepository,
        SessionInterface $session
    )
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
    }




    /**
     * @param string $username
     *
     * @param string $password
     *
     * @return UserInterface|null
     *
     * @throws NoRecordException
    */
    public function login(string $username, string $password): ?UserInterface
    {
          if (empty($username) || empty($password)) {
              return null;
          }

          $user = $this->userRepository->findByUsername($username);

          if ($user && PasswordHash::match($password, $user->getPassword())) {
              $this->session->set($this->authKey, $user->id);
              return $user;
          }

          return null;
    }






    /**
     * @inheritDoc
    */
    public function getUser(): ?UserInterface
    {
        if ($this->user) { return $this->user; }

        $userId = $this->session->get($this->authKey);

        if ($userId) {
            try {
                $this->user = $this->userRepository->find($userId);
                return $this->user;
            } catch (NoRecordException $e) {
                $this->session->delete($this->authKey);
            }
        }

        return null;
    }





    public function logout(): void
    {
         $this->session->delete($this->authKey);
    }
}