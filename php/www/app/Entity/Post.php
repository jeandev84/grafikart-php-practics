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
    protected ?int $id;

    protected ?string $name;

    protected ?string $slug;

    protected ?string $content;

    protected ?string $created_at;

    protected array $categories = [];


    public function __construct()
    {
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


    public function getContent(): ?string
    {
        return $this->content;
    }


    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
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


    public function getCategories(): array
    {
        return $this->categories;
    }
}