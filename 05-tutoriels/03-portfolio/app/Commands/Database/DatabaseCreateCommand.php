<?php
declare(strict_types=1);

namespace App\Commands\Database;


use App\Factory\ConnectionFactory;
use Grafikart\Console\Command\Command;
use Grafikart\Console\Input\Contract\InputInterface;
use Grafikart\Console\Output\Contract\OutputInterface;

/**
 * DatabaseCreateCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Commands\Database
 */
class DatabaseCreateCommand extends Command
{

     /**
      * @inheritdoc
     */
     public function __construct()
     {
         parent::__construct('database:create');
     }


     /**
      * @param InputInterface $input
      * @param OutputInterface $output
      * @return int
      * @throws \Exception
     */
     public function execute(InputInterface $input, OutputInterface $output): int
     {
         try {

             $connection = ConnectionFactory::make();
             $database   = $input->getArgument('--db');
             $connection->exec("CREATE DATABASE $database;");
             echo "Database $database successfully created";

             return Command::SUCCESS;

         } catch (\Throwable $e) {

             echo $e->getMessage(). PHP_EOL;

             return Command::FAILED;
         }
     }
}