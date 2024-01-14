<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;

/**
 * UploadedFileFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Request
 */
class UploadedFileFactory
{
    /**
     * @param array $file
     *
     * @return UploadedFileInterface
    */
    public static function createFromArray(array $file): UploadedFileInterface
    {
        return new UploadedFile(
            $file['name'],
            $file['full_path'],
            $file['type'],
            $file['tmp_name'],
            $file['error'],
            $file['size']
        );
    }
}