<?php
declare(strict_types=1);

namespace Grafikart\HTML\Form\Elements;

use Grafikart\HTML\Form\Elements\Contract\FormElement;

/**
 * Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\Form\Elements
 */
class Select extends FormElement
{

    /**
     * @inheritDoc
    */
    public function render(): string
    {
        $params = [
            'name'     => $this->getName(),
            'id'       => $this->getName(),
            'required' => $this->getParam('required', false)
        ];

        $html = [
            $this->renderLabel(),
            sprintf('<select %s>%s</select>', $this->renderAttributes($params), $this->renderOptions())
        ];

        return join(PHP_EOL, $html);
    }





    /**
     * @return string
    */
    protected function renderOptions(): string
    {
        $html = [];

        foreach ($this->getOptions() as $value => $label) {
            $selected = ($value == $this->value) ? ' selected="selected"': '';
            $html[]   = sprintf('<option value="%s"%s>%s</option>', $value, $selected, $label);
        }

        return join(PHP_EOL, $html);
    }



    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->getParam('options', []);
    }
}