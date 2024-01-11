<?php
declare(strict_types=1);

namespace App\DTO;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @SearchDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\DTO
 */
class SearchDto
{

    public string $searchQuery;

    public function __construct(string $searchQuery)
    {
        $this->searchQuery = $searchQuery;
    }
}