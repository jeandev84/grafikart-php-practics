<?php
declare(strict_types=1);

namespace App\Entity;


use App\Entity\Contract\EntityInterface;
use Grafikart\Database\ORM\Persistence\Entity\Traits\EntityTrait;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class User implements UserInterface, EntityInterface
{

    use EntityTrait;

    const ROLE_USER = 'ROLE_USER';

    protected ?string $username = null;
    protected ?string $password = null;


    public function getRoles(): array
    {
        return [self::ROLE_USER];
    }


    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }




    public function getIdentifier(): ?string
    {
        return $this->username;
    }



    public function getSalt(): string
    {
         return '';
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }


    public static function getClassName(): string
    {
        return self::class;
    }
}