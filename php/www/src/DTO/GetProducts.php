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
     public SearchDto $searchDto;

     public function __construct(SearchDto $searchDto)
     {
         $this->searchDto = $searchDto;
     }



     /**
      * @return SearchDto
     */
     public function getSearchDto(): SearchDto
     {
         return $this->searchDto;
     }
}