<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Category
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Category
{
      protected ?int $id;
      protected ?string $name;
      protected ?string $slug;

      public function getId(): ?int
      {
          return $this->id;
      }


      public function getName(): ?string
      {
          return $this->name;
      }

      public function setName(?string $name): Category
      {
          $this->name = $name;
          return $this;
      }

      public function getSlug(): ?string
      {
         return $this->slug;
      }

      public function setSlug(?string $slug): Category
      {
         $this->slug = $slug;
         return $this;
     }
}