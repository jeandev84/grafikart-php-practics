<?php
declare(strict_types=1);

namespace App\Entity;

use Grafikart\Utils\Number;

/**
 * Product
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Product
{
    protected ?int $id;
    protected ?string $name;
    protected ?float $price;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }


    /**
     * @param float|null $tva (TVA) En france
     * @return string
    */
    public function getFormatPrice(float $tva = null): string
    {
         if ($tva) {
             $this->price = $this->price * $tva;
         }

         return Number::format($this->price, 2, ',', ' ');
    }





    /**
     * @return string
    */
    public function getImagePath(): string
    {
        return "/assets/img/products/$this->id.png";
    }




    public function setPrice(?float $price): Product
    {
        $this->price = $price;

        return $this;
    }


}