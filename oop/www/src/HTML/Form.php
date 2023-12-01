<?php
declare(strict_types=1);


namespace Grafikart\HTML;

/**
 * Created by PhpStorm at 01.12.2023
 *
 * Class Form
 * permet de generer un formulaire rapidement et simplement
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
class Form
{


    /**
     * @var array Donnees utilisees pour le formulaire
     */
    protected array $data = [];


    /**
     * @var string Tag utilisees pour entourer les champs
     */
    protected string $surround = 'p';


    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


    /**
     * @param string $html Code html a entourer
     *
     * @return string
     */
    protected function surround(string $html): string
    {
        return "<{$this->surround}>$html</$this->surround>";
    }


    /**
     * @param string $name
     *
     * @return string
     */
    public function input(string $name): string
    {
        return $this->surround(
            sprintf('<input type="text" name="%s" value="%s">', $name, $this->getValue($name))
        );
    }


    /**
     * @param string $label
     *
     * @return string
     */
    public function submit(string $label = 'Envoyer'): string
    {
        return $this->surround(
            sprintf('<button type="submit">%s</button>', $label)
        );
    }



    public function date()
    {
         return new \DateTime();
    }



    /**
     * @param string $name
     *
     * @return mixed
     */
    protected function getValue(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }
}