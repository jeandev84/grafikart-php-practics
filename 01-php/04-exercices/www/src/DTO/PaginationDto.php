<?php
declare(strict_types=1);

namespace App\DTO;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @PaginationDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\DTO
 */
class PaginationDto
{

     private array $items = [];


     public function __construct(
         protected int $page,
         protected int $perPage
     )
     {
     }




     /**
      * @return array
     */
     public function getItems(): array
     {
        return $this->items;
     }




     public function setItems(array $items): self
     {
         $this->items = $items;

         return $this;
     }





     /**
      * @return int
     */
     public function getPage(): int
     {
         return $this->page;
     }




     /**
      * @return int
     */
     public function getPerPage(): int
     {
         return $this->perPage;
     }



     public function getTotalPages(): mixed
     {
         $count = $this->getCountItems();

         return ceil($count / $this->perPage);
     }




     public function getCountItems(): int
     {
         return count($this->items);
     }
}