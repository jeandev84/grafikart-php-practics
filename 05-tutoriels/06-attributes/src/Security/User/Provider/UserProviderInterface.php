<?php
declare(strict_types=1);

namespace Grafikart\Security\User\Provider;


use Grafikart\Security\User\UserInterface;

/**
 * UserProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\User\Provider
 */
interface UserProviderInterface
{

       /**
        * @param string $username
        * @return UserInterface|null
       */
       public function loadByUsername(string $username): ?UserInterface;


       /**
        * @param array $criteria
        * @return UserInterface|null
       */
       public function loadBy(array $criteria): ?UserInterface;
}