<?php
declare(strict_types=1);

namespace App\Blog\Entity;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @Category
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Entity
 */
class Category
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $slug = null;
}