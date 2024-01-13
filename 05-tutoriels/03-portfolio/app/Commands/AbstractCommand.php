<?php
declare(strict_types=1);

namespace App\Commands;

use Grafikart\Console\Command\Command;
use Grafikart\Container\Container;

/**
 * AbstractCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Commands
 */
abstract class AbstractCommand extends Command
{
    protected Container $app;


    /**
     * @param Container $app
     * @param string $name
     */
    public function __construct(Container $app, string $name)
    {
        parent::__construct($name);
        $this->app = $app;
    }
}