<?php
declare(strict_types=1);

namespace Grafikart\Security;

use Grafikart\Security\Authenticator\Contract\AuthenticatorInterface;
use Grafikart\Security\Authenticator\DTO\UserCredentials;
use Grafikart\Security\User\UserInterface;

/**
 * Auth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security
 */
class Auth
{

     /**
      * @var AuthenticatorInterface
     */
     protected AuthenticatorInterface $authenticator;


     /**
      * @param AuthenticatorInterface $authenticator
     */
     public function __construct(AuthenticatorInterface $authenticator)
     {
         $this->authenticator = $authenticator;
     }






     /**
      * @param string $username
      * @param string $password
      * @param bool $rememberMe
      * @return bool
     */
     public function attempt(string $username, string $password, bool $rememberMe = false): bool
     {
          return $this->authenticator->authenticate(
              new UserCredentials($username, $password, $rememberMe)
          );
     }




     /**
      * @return UserInterface
     */
     public function getUser(): UserInterface
     {
         return $this->authenticator->getUser();
     }




     /**
      * @param array $roles
      *
      * @return bool
     */
     public function isGranted(array $roles): bool
     {
         return $this->authenticator->isGranted($roles);
     }





     /**
      * @return mixed
     */
     public function logout(): mixed
     {
         return $this->authenticator->logout();
     }
}