<?php
declare(strict_types=1);

namespace Grafikart\Console\Input;

use Grafikart\Console\Input\Contract\InputInterface;

/**
 * ConsoleInput
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Console\Input
*/
abstract class ConsoleInput implements InputInterface
{

    /**
     * @var string
    */
    protected string $script;


    /**
     * @var string
    */
    protected string $firstArgument;


    /**
     * @var array
    */
    protected array $arguments = [];



    /**
     * @param array $tokens
    */
    public function __construct(array $tokens)
    {
        $script = array_shift($tokens);
        $this->setScript($script);
        $firstArgument = array_shift($tokens);
        $this->setFirstArgument($firstArgument ?? '');
        $this->parseTokens($tokens);
    }


    /**
     * @param array $tokens
     * @return void
    */
    abstract public function parseTokens(array $tokens): void;



    /**
     * @param string $script
     * @return $this
    */
    public function setScript(string $script): static
    {
        $this->script = $script;

        return $this;
    }


    /**
     * @return string
    */
    public function getScript(): string
    {
        return $this->script;
    }



    /**
     * @param string $firstArgument
     * @return $this
    */
    public function setFirstArgument(string $firstArgument): static
    {
        $this->firstArgument = $firstArgument;

        return $this;
    }





    /**
     * @return string
     */
    public function getFirstArgument(): string
    {
        return $this->firstArgument;
    }


    /**
     * @param array $arguments
     * @return $this
    */
    public function setArguments(array $arguments): static
    {
        $this->arguments = $arguments;

        return $this;
    }


    /**
     * @param string $name
     * @param string $default
     * @return string
    */
    public function getArgument(string $name, string $default = ''): string
    {
        return $this->arguments[$name] ?? $default;
    }


    /**
     * @return array
    */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}