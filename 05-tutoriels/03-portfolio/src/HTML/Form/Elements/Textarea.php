<?php
declare(strict_types=1);

namespace Grafikart\HTML\Form\Elements;

use Grafikart\HTML\Form\Elements\Contract\FormElement;

/**
 * Textarea
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\Form\Elements
 */
class Textarea extends FormElement
{

    /**
     * @inheritDoc
    */
    public function render(): string
    {
        $params = [
            'name'     => $this->getName(),
            'id'       => $this->getAttribute('id', $this->getName()),
            'required' => $this->getParam('required', false)
        ];

        $html = [
            $this->renderLabel(),
            sprintf('<textarea %s>%s</textarea>', $this->renderAttributes($params), $this->getValue())
        ];

        return join(PHP_EOL, $html);
    }
}