<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Exception;

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
     protected ?string $name;
     protected ?string $description;
     protected ?string $start_at;
     protected ?string $end_at;

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
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }


    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }


    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    /**
     * @return DateTime
     */
    public function getStartAt(): DateTime
    {
        return new DateTime($this->start_at);
    }


    /**
     * @param string|null $start
    */
    public function setStartAt(?string $start): void
    {
        $this->start_at = $start;
    }


    /**
     * @return DateTime
     * @throws Exception
     */
    public function getEndAt(): DateTime
    {
        return new DateTime($this->end_at);
    }


    /**
     * @param string|null $end
     */
    public function setEndAt(?string $end): void
    {
        $this->end_at = $end;
    }
}