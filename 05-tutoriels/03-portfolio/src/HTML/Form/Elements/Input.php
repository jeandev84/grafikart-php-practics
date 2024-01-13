<?php
declare(strict_types=1);

namespace Grafikart\HTML\Form\Elements;

use Grafikart\HTML\Form\Elements\Contract\FormElement;

/**
 * Input
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\Form\Elements
 */
class Input extends FormElement
{

    /**
     * @var string
    */
    protected string $type = '';




    /**
     * @param string $type
     * @param string $name
     * @param $value
     * @param array $options
    */
    public function __construct(string $type, string $name, $value, array $options = [])
    {
        parent::__construct($name, $value, $options);
        $this->type = $type;
    }




    /**
     * @inheritDoc
    */
    public function render(): string
    {
        $params = [
            'type'     => $this->type,
            'name'     => $this->getName(),
            'value'    => $this->getValue(),
            'id'       => $this->getName(),
            'required' => $this->getOption('required', false)
        ];

        if ($attrs = $this->getOption('attrs')) {
            $params = array_merge($params, $attrs);
        }

        $html = [$this->renderLabel(), sprintf('<input %s>', $this->buildAttributes($params))];

        return join(PHP_EOL, $html);
    }
}