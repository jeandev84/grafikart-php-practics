<?php
declare(strict_types=1);

namespace App\Blog\Entity;


use Framework\Database\ORM\Contract\HasImageInterface;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @Post
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Entity
 */
class Post implements HasImageInterface
{
     public ?int $id = null;
     public ?string $name = null;
     public ?string $slug = null;
     public ?string $content = null;
     public $createdAt;
     public $updatedAt;
     public ?string $categoryName = null;
     public $image;



     public function setCreatedAt(\DateTime|string $datetime): self
     {
         if (is_string($datetime)) {
             $datetime = new \DateTime($datetime);
         }

         $this->createdAt = $datetime;

         return $this;
     }




    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }


    /**
     * @param \DateTime|string $datetime
     * @return $this
     * @throws \Exception
     */
     public function setUpdatedAt(\DateTime|string $datetime): self
     {
         if (is_string($datetime)) {
             $datetime = new \DateTime($datetime);
         }

         $this->updatedAt = $datetime;

         return $this;
     }




    /**
     * @return \DateTime|null
    */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }




     /**
      * @inheritdoc
     */
     public function getThumb(): string
     {
         ['filename' => $filename, 'extension' => $extension] = pathinfo($this->image);

         return $this->getImagePath() . '/'. $filename .'_thumb.'. $extension ;
     }



     public function getImageUrl(): string
     {
          return $this->getOriginalImage();
     }



     
     /**
      * @inheritdoc
     */
     public function getOriginalImage(): string
     {
         return $this->getImagePath() . '/'. $this->image;
     }





     /**
      * @inheritDoc
     */
     public function getImagePath(): string
     {
         return '/uploads/posts';
     }
}