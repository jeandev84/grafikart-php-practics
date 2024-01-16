<?php
declare(strict_types=1);

namespace Grafikart\Http\Response;

/**
 * CsvResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Response
*/
class CsvResponse extends BinaryResponse
{

     /**
      * @param string $filename
     */
     public function __construct(string $filename)
     {
         parent::__construct($filename, 'text/csv');
     }
}