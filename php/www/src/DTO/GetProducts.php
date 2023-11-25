<?php
declare(strict_types=1);

namespace App\DTO;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @GetProducts
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\DTO
 */
class GetProducts
{

     const PER_PAGE  = 20;

     public SearchDto $searchDto;


     public PaginationDto $paginationDto;


     public function __construct(
         SearchDto $searchDto,
         PaginationDto $paginationDto
     )
     {
         $this->searchDto     = $searchDto;
         $this->paginationDto = $paginationDto;
     }



     /**
      * @return SearchDto
     */
     public function getSearchDto(): SearchDto
     {
         return $this->searchDto;
     }



     /**
      * @return PaginationDto
     */
     public function getPaginationDto(): PaginationDto
     {
         return $this->paginationDto;
     }




     public function getPerPage(): int
     {
         return self::PER_PAGE;
     }
}