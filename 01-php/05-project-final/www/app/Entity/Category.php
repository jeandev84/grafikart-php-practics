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
      protected ?int $id = null;
      protected ?string $name = null;
      protected ?string $slug = null;
      protected ?int $post_id = null;
      protected ?Post $post = null;


     /**
      * @return int|null
     */
     public function getId(): ?int
     {
         return $this->id;
     }


    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
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


    /**
     * @return Post|null
     */
    public function getPost(): ?Post
    {
        return $this->post;
    }


    /**
     * @param Post|null $post
     *
     * @return $this
    */
    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}