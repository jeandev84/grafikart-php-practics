<?php
declare(strict_types=1);

namespace App\DTO\Input;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @GetPosts
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\DTO
 */
class GetPosts
{

    public function __construct(
        protected PaginationDto $paginationDto
    )
    {
    }



    /**
     * @return PaginationDto
    */
    public function getPaginationDto(): PaginationDto
    {
        return $this->paginationDto;
    }
}