<?php
declare(strict_types=1);

namespace Grafikart;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
*/
class Connection
{

    protected string $id;


    public function __construct(
        protected string $username,
        protected string $password,
        protected string $database
    )
    {
        $this->id = uniqid();
    }
}