<?php
declare(strict_types=1);

namespace Grafikart\Http\Response;

/**
 * BinaryResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Response
*/
class BinaryResponse extends Response
{

     /**
      * @param string $body
      * @param string $filename
      * @param string $type
      * @param int $status
     */
     public function __construct(string $body, string $filename, string $type, int $status = 200)
     {
         parent::__construct($body, $status, [
             'Content-Type'        => $type,
             'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
         ]);
     }
}