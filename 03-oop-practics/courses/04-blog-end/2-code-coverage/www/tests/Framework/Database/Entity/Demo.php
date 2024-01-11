<?php
declare(strict_types=1);

namespace Tests\Framework\Database\Entity;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @Demo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Database\Entity
 */
class Demo
{

     protected ?string $slug = null;


     /**
      * @param string|null $slug
      *
      * @return $this
     */
     public function setSlug(?string $slug): self
     {
          $this->slug = $slug . 'demo';

          return $this;
     }


    /**
     * @return string|null
    */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
}