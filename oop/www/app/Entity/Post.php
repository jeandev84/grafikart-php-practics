<?php
declare(strict_types=1);

namespace App\Entity;


/**
 * Created by PhpStorm at 01.12.2023
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
    protected ?string $title = null;
    protected ?string $content = null;
    protected ?string $created_at = null;


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
     * @return $this
    */
    public function setTitle(?string $title): Post
    {
        $this->title = $title;

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
     * @param string|null $content
     * @return $this
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }




    /**
     * @return string|null
    */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }


    /**
     * @param string|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?string $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }


    /**
     * Returns url (lien)
     *
     * @return string
     */
    public function getUrl(): string
    {
         return sprintf('?p=post&id=%s', $this->id);
    }




    /**
     * Returns an excerpt ( un extrait de text )
     *
     * @return string|null
     */
    public function getExcerpt(): ?string
    {
        $content  = substr($this->content, 0, 100) . "...";
        $html[]   = sprintf('<p>%s</p>', $content);
        $html[]   = sprintf('<p><a href="%s">Voir la suite</a></p>', $this->getURL());

        return join($html);
    }



    public function __get(string $name)
    {
         $method = sprintf('get%s', ucfirst($name));

         return $this->{$name} = $this->{$method}();
    }
}