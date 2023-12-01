<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Repository\Exception;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @NotFoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\ORM\Persistence\Repository\Exception
 */
class NotFoundException extends \Exception
{
     public function __construct(string $table, $id)
     {
         parent::__construct("Could not found records for id #$id in the table '$table'", 404);
     }
}