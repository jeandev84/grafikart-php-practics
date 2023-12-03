<?php
declare(strict_types=1);

namespace Grafikart;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Model
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
class Model
{

    protected Connection $connection;


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}