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
     public $id;
     public $name;
     public $slug;
     public $content;
     public $created_at;
     public $updated_at;


     public function __construct()
     {
         if ($this->created_at) {
             $this->created_at = new \DateTime($this->created_at);
         }


         if ($this->updated_at) {
             $this->updated_at = new \DateTime($this->updated_at);
         }
     }
}