<?php
declare(strict_types=1);


namespace Grafikart\HTML;

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
    public function input(string $name, string $label, array $options = []): string
    {
        $type = $options['type'] ?? 'text';

        return $this->surround(
            sprintf('
                <label for="%s">%s</label><input type="%s" name="%s" value="%s" id="%s" class="form-control">',
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