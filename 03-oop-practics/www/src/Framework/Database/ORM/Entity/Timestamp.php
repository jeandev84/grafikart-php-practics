<?php
declare(strict_types=1);

namespace App\Framework\Database\ORM\Entity;


use DateTime;

/**
 * Created by PhpStorm at 10.12.2023
 *
 * @Timestamp
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Framework\Database\ORM\Entity
 */
trait Timestamp
{

    /**
     * @var DateTime|null
    */
    protected ?DateTime $createdAt = null;


    /**
     * @var DateTime|null
    */
    protected ?DateTime $updatedAt = null;





    /**
     * @return DateTime|null
    */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }





    /**
     * @param DateTime|null $updatedAt
     *
     * @return $this
    */
    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }




    /**
     * @param DateTime|null $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }




    /**
     * @return DateTime|null
   */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt ?: new DateTime();
    }
}