<?php
declare(strict_types=1);

namespace Grafikart\Console\Command\Contract;


use Grafikart\Console\Input\Contract\InputInterface;
use Grafikart\Console\Output\Contract\OutputInterface;

/**
 * CommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Console\Command\Contract
 */
interface CommandInterface
{
       /**
        * @param InputInterface $input
        * @param OutputInterface $output
        * @return int
      */
      public function execute(InputInterface $input, OutputInterface $output): int;
}