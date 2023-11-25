<?php
declare(strict_types=1);

namespace App\Console\Input;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @ConsolePrompt
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Console\Input
 */
class ConsolePrompt
{


    public function readline(string $value): string
    {
        return readline($value);
    }
}