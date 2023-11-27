<?php
declare(strict_types=1);

namespace App\Entity;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Post
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Post
{
       protected ?int $id;

       protected ?string $name;

       protected ?string $content;

       protected ?string $created_at;

       protected array $categories = [];


}