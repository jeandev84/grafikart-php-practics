<?php
declare(strict_types=1);

namespace App\Entity\Contract;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @HasGenerateUrlInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\Contract
 */
interface HasGenerateUrlInterface
{
    public function getUrl(): string;
}