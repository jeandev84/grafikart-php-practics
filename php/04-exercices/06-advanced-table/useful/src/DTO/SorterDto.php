<?php
declare(strict_types=1);

namespace App\DTO;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @SorterDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\DTO
 *
 * TODO code reviews
 */
class SorterDto
{

     protected string $sort = '';
     protected string $direction = 'asc';
     protected array $directions = ['asc' , 'desc'];
     protected array $sortables = [];



     public function __construct(array $sortables, string $sort, string $direction)
     {
          if (in_array($sort, $sortables)) {
              $this->setSort($sort);
          }

          $this->setSortables($sortables);
          $this->setDirection($direction);
     }



    /**
     * @param array $sortables
     *
     * @return $this
    */
    public function setSortables(array $sortables): self
    {
        $this->sortables = $sortables;

        return $this;
    }




    /**
     * @param string $sort
     *
     * @return $this
    */
    public function setSort(string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }



     /**
     * @return string
    */
    public function getSort(): string
    {
        return $this->sort;
    }





    /**
     * @param string $direction
     *
     * @return $this
    */
    public function setDirection(string $direction): self
    {
        if (! in_array($direction, $this->directions)) {
            $direction = 'asc';
        }

        $this->direction = $direction;

        return $this;
    }




    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }
}