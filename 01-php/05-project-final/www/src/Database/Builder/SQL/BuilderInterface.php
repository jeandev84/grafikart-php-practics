<?php
declare(strict_types=1);

namespace Grafikart\Database\Builder\SQL;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @BuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Builder\SQL
 */
interface BuilderInterface
{
     public function getSQL();
}