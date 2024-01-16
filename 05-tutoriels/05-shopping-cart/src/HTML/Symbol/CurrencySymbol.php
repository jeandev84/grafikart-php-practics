<?php
declare(strict_types=1);

namespace Grafikart\HTML\Symbol;

/**
 * CurrencySymbol
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\CurrencySymbol
 */
class CurrencySymbol
{
     public static function euro(): string
     {
         return "&euro;"; // &#8364; &#x20AC
     }
}