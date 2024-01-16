<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;

/**
 * UploadedFileNormalizer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Request
 */
class UploadedFileNormalizer
{

     /**
      * @param array $files
      * @return array
     */
     public static function normalize(array $files): array
     {
          $normalized = [];
          foreach ($files['tmp_name'] as $k => $v) {
              $normalized[] = [
                  'name'      => $files['name'][$k],
                  'full_path' => $files['full_path'][$k],
                  'tmp_name'  => $files['tmp_name'][$k],
                  'size'      => $files['size'][$k],
                  'type'      => $files['type'][$k],
                  'error'     => $files['error'][$k]
              ];
          }
          return $normalized;
     }
}