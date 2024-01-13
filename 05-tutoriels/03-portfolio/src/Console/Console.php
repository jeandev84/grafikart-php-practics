<?php
declare(strict_types=1);

namespace Grafikart\Console;

use Grafikart\Console\Command\Command;
use Grafikart\Console\Input\Contract\InputInterface;
use Grafikart\Console\Output\Contract\OutputInterface;

/**
 * Console
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Console
 */
class Console
{

     /**
      * @var Command[]
     */
     protected array $commands = [];



     /**
      * @param Command $command
      * @return Command
     */
     public function add(Command $command): Command
     {
         return $this->commands[$command->getName()] = $command;
     }



     /**
      * @param array $commands
      * @return $this
     */
     public function addCommands(array $commands): static
     {
         foreach ($commands as $command) {
             $this->add($command);
         }

         return $this;
     }





     /**
      * @param string $name
      *
      * @return bool
     */
     public function has(string $name): bool
     {
         return isset($this->commands[$name]);
     }




     /**
      * @param string $name
      * @param Command|null $default
      * @return Command|null
     */
     public function getCommand(string $name, Command $default = null): ?Command
     {
         return $this->commands[$name] ?? $default;
     }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
     public function run(InputInterface $input, OutputInterface $output): int
     {
           $firstArgument = $input->getFirstArgument();

           if (! $this->has($firstArgument)) {
                return Command::FAILED;
           }

           $command = $this->getCommand($firstArgument);

           return $command->run($input, $output);
     }
}