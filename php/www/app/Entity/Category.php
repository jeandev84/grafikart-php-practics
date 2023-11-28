<?php
declare(strict_types=1);

namespace App\Entity;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Category
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Category
{
      protected ?int $id;
      protected ?string $name;
      protected ?string $slug;
      protected ?int $post_id;


     /**
      * @return int|null
     */
     public function getId(): ?int
     {
         return $this->id;
     }




    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }



    /**
     * @param string|null $name
     *
     * @return $this
    */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }



    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }





    /**
     * @param string|null $slug
     * @return Category
    */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


    /**
     * @return int|null
    */
    public function getPostId(): ?int
    {
        return $this->post_id;
    }
}