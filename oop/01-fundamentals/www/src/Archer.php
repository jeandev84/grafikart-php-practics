<?php
declare(strict_types=1);

namespace Grafikart;
/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Archer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
class Archer extends Person
{
    protected int $life = 40;


    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->life = $this->life / 2;
    }


    public function attack(Person $target): void
    {
        $target->life -= $this->attack;
        parent::attack($target);
    }
}