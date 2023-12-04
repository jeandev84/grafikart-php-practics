<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Repository;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @EntityRepositoryIInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\ORM\Persistence\Repository
 */
interface EntityRepositoryIInterface
{
     public function find(int $id): mixed;
     public function findAll(): array;

    public function getClassName(): string;
}