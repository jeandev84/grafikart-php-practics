<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


/**
 * BindType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\Connection
 */
enum BindType
{
    const NULL    = 0;
    const INT     = 1;
    const STR     = 2;
    const BOOLEAN = 3;
}
