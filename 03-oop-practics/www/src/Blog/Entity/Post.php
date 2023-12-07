<?php
declare(strict_types=1);

namespace App\Blog\Entity;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @Post
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Entity
 */
class Post
{
     public ?int $id = null;
     public ?string $name = null;
     public ?string $slug = null;
     public ?string $content = null;
     public $createdAt;
     public $updatedAt;
     public ?string $categoryName = null;
     public $image;



     public function setCreatedAt($datetime)
     {
         if (is_string($datetime)) {
             $this->createdAt = new \DateTime($datetime);
         }
     }




     public function setUpdatedAt($datetime)
     {
         if (is_string($datetime)) {
             $this->updatedAt = new \DateTime($datetime);
         }
     }
}