<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\User;
use Grafikart\Database\Connection\PdoConnection;
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

     public function __construct(PdoConnection $connection)
     {
         parent::__construct($connection, User::class);
     }
}