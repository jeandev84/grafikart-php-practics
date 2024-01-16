<?php
declare(strict_types=1);

namespace Grafikart\Console\Input\Contract;


/**
 * InputInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Console\Input\Contract
 */
interface InputInterface
{

     /**
      * @return string
     */
     public function getFirstArgument(): string;



    /**
     * @param string $name
     * @param string $default
     * @return string
    */
    public function getArgument(string $name, string $default = ''): string;
}