<?php
declare(strict_types=1);

namespace App\Shop\Entity;


use App\Framework\Database\ORM\Entity\Timestamp;

/**
 * Created by PhpStorm at 10.12.2023
 *
 * @Product
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Shop\Entity
 */
class Product
{

      protected ?int $id = null;
      protected ?string $name = null;
      protected ?string $description = null;
      protected ?string $slug = null;
      protected ?float $price = null;
      protected ?string $image = null;


      use Timestamp;


     public function getId(): ?int
     {
        return $this->id;
     }

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
    public function getDescription(): ?string
    {
        return $this->description;
    }




    /**
     * @param string|null $description
     * @return $this
    */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     *
     * @return $this
    */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }




    /**
     * @return float|null
    */
    public function getPrice(): ?float
    {
        return $this->price;
    }




    /**
     * @param float|null $price
     *
     * @return $this
    */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }




    /**
     * @return string|null
    */
    public function getImage(): ?string
    {
        return $this->image;
    }


    /**
     * @param string|null $image
     * @return $this
    */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}