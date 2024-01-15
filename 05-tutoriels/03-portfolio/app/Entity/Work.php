<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Work
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Work
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $slug;
    protected ?string $content;
    protected ?int $category_id;
    protected ?int $image_id;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Work
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): Work
    {
        $this->slug = $slug;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): Work
    {
        $this->content = $content;
        return $this;
    }




    /**
     * @return int|null
    */
    public function getCategory(): ?int
    {
        return $this->category_id;
    }


    public function setCategory(Category $category): Work
    {
        $this->category_id = $category->getId();
        return $this;
    }




    /**
     * @return int|null
    */
    public function getImage(): ?int
    {
        return $this->image_id;
    }


    /**
     * @param Image $image
     * @return $this
    */
    public function setImage(Image $image): static
    {
        $this->image_id = $image->getId();

        return $this;
    }

}