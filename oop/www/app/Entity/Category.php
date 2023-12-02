<?php
declare(strict_types=1);

namespace App\Entity;


use App\Entity\Contract\EntityInterface;
use App\Entity\Traits\EntityTrait;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Category
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Category implements EntityInterface
{

      use EntityTrait;

      protected ?int $id = null;
      protected ?string $title = null;


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
    public function getTitle(): ?string
    {
        return $this->title;
    }




    /**
     * @param string|null $title
     *
     * @return $this
    */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getUrl(): string
    {
         return sprintf('/category/%s', $this->id);
    }
}