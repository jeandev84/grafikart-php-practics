<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Video
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Video
{
     protected ?int $id;
     protected ?string $title; // Decomposer un site en PHP
     protected ?string $content; // <p>Dans ce tutoriel vous apprendrez ..</p>
     protected ?float $duration; // 1077,3

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Video
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): Video
    {
        $this->content = $content;
        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(?float $duration): Video
    {
        $this->duration = $duration;
        return $this;
    }
}