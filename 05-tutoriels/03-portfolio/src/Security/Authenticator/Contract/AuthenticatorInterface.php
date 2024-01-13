<?php
declare(strict_types=1);

namespace Grafikart\Security\Authenticator\Contract;


use Grafikart\Security\Authenticator\DTO\UserCredentialsInterface;
use Grafikart\Security\User\Contract\UserInterface;

/**
 * AuthenticatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Authenticator\Contract
 */
interface AuthenticatorInterface
{

     /**
      * @param UserCredentialsInterface $payload
      *
      * @return bool
     */
     public function authenticate(UserCredentialsInterface $payload): bool;




     /**
      * @return UserInterface
     */
     public function getUser(): UserInterface;




     /**
      * @param array $roles
      * @return bool
     */
     public function isGranted(array $roles): bool;






     /**
      * @return mixed
     */
     public function logout(): mixed;
}