<?php
declare(strict_types=1);

namespace App\DTO;


use App\DTO\Input\PaginationDto;

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

     public SearchDto $searchDto;


     public PaginationDto $paginationDto;



     public SorterDto $sorterDto;


     public function __construct(
         SearchDto $searchDto,
         PaginationDto $paginationDto,
         SorterDto $sorterDto
     )
     {
         $this->searchDto     = $searchDto;
         $this->paginationDto = $paginationDto;
         $this->sorterDto     = $sorterDto;
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





    /**
     * @return SorterDto
    */
    public function getSorterDto(): SorterDto
    {
        return $this->sorterDto;
    }
}