<?php
declare(strict_types=1);

namespace App\Auth\Repository;


use App\Auth\Entity\User;
use Framework\Database\ORM\EntityRepository;
use Framework\Database\ORM\Exceptions\NoRecordException;
use Framework\Security\User\UserInterface;
use PDO;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @UserRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Repository
 */
class UserRepository extends EntityRepository
{

     public function __construct(PDO $connection, string $entity= User::class)
     {
         parent::__construct($connection, $entity, 'users');
     }




     /**
      * @param string $username
      *
      * @return User|null
      *
      * @throws NoRecordException
     */
     public function findByUsername(string $username): ?User
     {
          return $this->findBy('username', $username);
     }
}