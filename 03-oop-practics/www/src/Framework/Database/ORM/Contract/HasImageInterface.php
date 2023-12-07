<?php
declare(strict_types=1);

namespace Framework\Database\ORM\Contract;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @HasImageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database\ORM\Contract
 */
interface HasImageInterface
{

    /**
     * Returns image upload directory
     *
     * @return string
    */
    public function getImagePath(): string;



    /**
     * Returns path of image thumb
     *
     * @return string
    */
    public function getThumb(): string;




    /**
     * Returns path of image original
     *
     * @return string
    */
    public function getOriginalImage(): string;
}