<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\User;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class UserRepository extends ServiceRepository
{

    protected string $tableName = 'user';

     public function __construct(PdoConnection $connection)
     {
         parent::__construct($connection, User::class);
     }



     public function findByUsername(string $username): ?User
     {
         $result = $this->connection
             ->statement("SELECT * FROM {$this->tableName} WHERE username = :username")
             ->setParameters(compact('username'))
             ->map($this->classname)
             ->fetch()
             ->one();

         if ($result === false) {
             throw new NotFoundException($this->tableName, $username);
         }

         return $result;
     }
}