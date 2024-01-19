<?php
declare(strict_types=1);

namespace Grafikart\Console\Command;

use Exception;
use Grafikart\Console\Command\Contract\CommandInterface;
use Grafikart\Console\Input\Contract\InputInterface;
use Grafikart\Console\Output\Contract\OutputInterface;

/**
 * Command
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Console\Command
 */
class Command implements CommandInterface
{

    const SUCCESS = 1;
    const FAILED  = 0;



    /**
     * @var string
    */
    protected string $name;




    /**
     * @param string $name
    */
    public function __construct(string $name)
    {
        $this->name = $name;
    }



    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
     * @throws Exception
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
         throw new Exception(get_called_class() . ' must implements method execute()');
    }





    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
    */
    public function run(InputInterface $input, OutputInterface $output): int
    {
         return $this->execute($input, $output);
    }
}