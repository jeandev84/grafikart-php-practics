<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\User;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @UserRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class UserRepository extends ServiceRepository
{

    /**
     * @var string
    */
    protected string $tableName = 'users';


    /**
     * @param PdoConnection $connection
    */
    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, User::class);
    }




    /**
     * @param string $username
     *
     * @return User|null
    */
    public function findByUsername(string $username): ?User
    {
         return $this->findOneBy(compact('username'));
    }
}