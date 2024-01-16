<?php
declare(strict_types=1);

namespace App\Security\Providers;

use App\Repository\UserRepository;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Security\User\Provider\UserProviderInterface;
use Grafikart\Security\User\UserInterface;

/**
 * UserProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Security\Providers
 */
class UserProvider implements UserProviderInterface
{

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;


    /**
     * @param PdoConnection $connection
     */
    public function __construct(PdoConnection $connection)
    {
        $this->userRepository = new UserRepository($connection);
    }


    /**
     * @inheritDoc
    */
    public function loadByUsername(string $username): ?UserInterface
    {
         return $this->userRepository->findByUsername($username);
    }



    /**
     * @inheritDoc
    */
    public function loadBy(array $criteria): ?UserInterface
    {
        $user = $this->userRepository->findOneBy($criteria);

        return $user ?: null;
    }
}