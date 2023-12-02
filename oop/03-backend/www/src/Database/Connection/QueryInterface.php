<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @QueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Connection
 */
interface QueryInterface
{
    public function prepare(string $sql): self;

    public function bindParam($name, $value, int $type): self;

    public function query(string $sql): self;

    public function setParameters(array $parameters): self;

    public function map(string $classname): self;
    public function execute(): mixed;
    public function lastId(): int;
    public function fetch(int $mode = 0): QueryResultInterface;
    public function exec(string $sql): mixed;
}