<?php
declare(strict_types=1);

namespace Grafikart\Service\Csv;


/**
 * CsvConvertor
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Grafikart\Service\Csv
 */
class CsvConvertor
{
       /**
        * @param array $data
        * @return string
       */
       public static function convertToCsv(array $data): string
       {
            $index = 0;
            $csv   = [];

            foreach ($data as $value) {
                if ($index === 0) {
                    $csv[] = '"'. join('";"', array_keys($value)) . '"';
                }
                $csv[] = '"'. join('";"', $value) . '"';
                $index++;
            }

            return join(PHP_EOL, array_filter($csv));
       }
}