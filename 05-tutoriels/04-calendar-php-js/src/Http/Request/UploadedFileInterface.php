<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;


/**
 * UploadedFileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Request
 */
interface UploadedFileInterface
{

    /**
     * @return int|null
    */
    public function getSize(): ?int;



    /**
     * @return int
    */
    public function getError(): int;


    /**
     * @return string|null
    */
    public function getClientFilename(): ?string;


    /**
     * @return string|null
    */
    public function getClientMediaType(): ?string;




    /**
     * @param string $targetPath
     * @return void
    */
    public function moveTo(string $targetPath): void;
}