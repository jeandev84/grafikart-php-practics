<?php
declare(strict_types=1);

namespace App\Entity;


use DateTime;
use Grafikart\Helpers\Text;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Post
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Post
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $slug = null;
    protected ?string $content = null;
    protected ?string $created_at = null;
    protected ?string $image = null;
    protected array $categories = [];


    public function __construct()
    {
    }


    /**
     * @param int $id
     * @return Post
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }



    public function setName(?string $name): Post
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
     *
     * @return $this
    */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }




    public function getExcerpt(): ?string
    {
         if (! $this->content) {
             return null;
         }

         return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }


    public function getFormattedContent(): ?string
    {
        return nl2br(e($this->content));
    }


    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }



    /**
     * @return string|null
    */
    public function getContent(): ?string
    {
        return $this->content;
    }


    /**
     * @return DateTime
     * @throws \Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }


    public function setCreatedAt(?string $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }




    public function addCategory(Category $category): self
    {
        $category->setPost($this);

        $this->categories[] = $category;

        return $this;
    }


    /**
     * @return Category[]
    */
    public function getCategories(): array
    {
        return $this->categories;
    }



    public function getCategoryIds(): array
    {
        /*
        return array_filter($this->categories, function (Category $category) {
            return $category->getId();
        });
        */

        $ids = [];
        foreach ($this->categories as $category) {
            $ids[] = $category->getId();
        }

        return $ids;
    }


    /**
     * @param Category[] $categories
     *
     * @return $this
    */
    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

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
     * @param array|string $image
     *
     * @return $this
    */
    public function setImage(array|string $image): self
    {
        if (is_array($image) && !empty($image['tmp_name'])) {
             $this->image = $image['tmp_name'];
        }

        if (is_string($image) && !empty($image)) {
            $this->image = $image;
        }

        return $this;
    }
}