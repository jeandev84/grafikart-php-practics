<?php
declare(strict_types=1);

namespace App\Entity;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @Post
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Post
{

    public function getImage(): string
    {
        return "/uploads/demo.jpg";
    }
}