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
    protected mixed $data;


    /**
     * @var string Tag utilisees pour entourer les champs
     */
    protected string $surround = 'p';


    /**
     * @param array|object $data
     */
    public function __construct(array|object $data = null)
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
     * @param string $label
     * @param array $options
     * @return string
    */
    public function input(string $name, string $label, array $options = []): string
    {
        $type = $options['type'] ?? 'text';

        return $this->surround(
            sprintf('<label for="%s">%s</label><input type="%s" name="%s" value="%s" id="%s">',
                $name,
                $label,
                $type,
                $name,
                $this->getValue($name),
                $name
            )
        );
    }


    /**
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function textarea(string $name, string $label, array $options = []): string
    {
        $class = $options['class'] ?? '';
        return $this->surround(
            sprintf('<label for="%s">%s</label><textarea name="%s" id="%s" class="%s">%s</textarea>',
                $name,
                $label,
                $name,
                $name,
                $class,
                $this->getValue($name)
            )
        );
    }




    public function select(string $name, string $label, array $options, array $attributes = []): string
    {
        $class = $attributes['class'] ?? '';
        $label = "<label>$label</label>";
        $input = sprintf('<select class="%s" name="%s">', $class, $name);
        foreach ($options as $k => $v) {
           $input .= sprintf('<option value="%s">%s</option>', $k, $v);
        }
        $input .= '</select>';
        return $this->surround(sprintf('%s%s', $label, $input));
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



    /**
     * @param string $name
     *
     * @return mixed
     */
    protected function getValue(string $name): mixed
    {
        if (is_object($this->data)) {
             return $this->data->{$name};
        }

        return $this->data[$name] ?? null;
    }
}