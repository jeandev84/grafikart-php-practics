<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * ImageService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Image
{
    protected ?int $id;
    protected ?string $name;
    protected ?int $work_id;


    /**
     * @return int|null
    */
    public function getId(): ?int
    {
        return $this->id;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Image
    {
        $this->name = $name;

        return $this;
    }





    /**
     * @return int|null
    */
    public function getWork(): ?int
    {
        return $this->work_id;
    }




    /**
     * @param Work $work
     * @return $this
    */
    public function setWork(Work $work): Image
    {
        $this->work_id = $work->getId();
        return $this;
    }


}