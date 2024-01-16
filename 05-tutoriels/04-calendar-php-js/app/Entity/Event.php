<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Event
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Event
{
     protected ?int $id;
     protected ?string $title;
     protected ?string $date;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Event
    {
        $this->title = $title;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): Event
    {
        $this->date = $date;
        return $this;
    }
}