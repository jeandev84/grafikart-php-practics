<?php
declare(strict_types=1);

namespace Grafikart\Service\Currency;

/**
 * Currency
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Currency
*/
class Currency
{

     /**
      * @return string
     */
     public static function euro(): string
     {
         return "€";
     }



     /**
      * @return string
     */
     public static function dollars(): string
     {
         return "$";
     }



     /**
      * @return string
     */
     public static function rub(): string
     {
         return "руб";
     }
}