<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @QueryResultInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Connection
 */
interface QueryResultInterface
{
    public function all(): array;

    /**
     * @return mixed
     */
    public function one(): mixed;

    public function assoc(): array;

    public function nums(): mixed;


    public function count(): int;
}