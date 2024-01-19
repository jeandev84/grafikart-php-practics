<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;
use Grafikart\Database\ORM\Repository\ServiceRepository;

/**
 * UserRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
*/
class UserRepository extends ServiceRepository
{

    /**
     * @param PdoConnection $connection
     * @throws \ReflectionException
    */
    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, User::class);
    }



    /**
     * @param string $username
     * @return User|null
    */
    public function findByUsername(string $username): ?User
    {
         $user = $this->findOneBy(compact('username'));

          return $user ?: null;
    }
}