<?php
declare(strict_types=1);

use HTML\Form;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @BootstrapForm
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
class BootstrapForm extends Form
{


    /**
     * @inheritDoc
     */
    protected function surround(string $html): string
    {
        return sprintf('<div class="form-group">%s</div>', $html);
    }


    /**
     * @inheritDoc
     */
    public function input(string $name): string
    {
        return $this->surround(
            sprintf('
                <label>%s</label><input type="text" name="%s" value="%s" class="form-control">
             ', $name, $name, $this->getValue($name))
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
            sprintf('<button type="submit" class="btn btn-primary">%s</button>', $label)
        );
    }
}