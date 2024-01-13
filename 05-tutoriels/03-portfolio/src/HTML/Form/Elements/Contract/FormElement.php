<?php
declare(strict_types=1);

namespace Grafikart\HTML\Form\Elements\Contract;

/**
 * FormElement
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\Form\Elements\Contract
 */
abstract class FormElement implements \Stringable
{

      /**
       * @var string
      */
      protected string $name;


      /**
       * @var mixed
      */
      protected $value;


      /**
       * @var FormElement|null
      */
      protected ?FormElement $parent = null;



      /**
       * @var array
      */
      protected array $options = [
          'label' => null,
          'attrs' => []
      ];




      /**
       * @param string $name
       * @param $value
       * @param array $options
      */
      public function __construct(string $name, $value, array $options = [])
      {
          $this->name    = $name;
          $this->value   = $value;
          $this->withOptions($options);
      }



      /**
       * Render HTML
       *
       * @return string
      */
      abstract public function render(): string;





      /**
       * @param array $options
       * @return $this
      */
      public function withOptions(array $options): static
      {
          $this->options = array_merge($this->options, $options);

          return $this;
      }




      /**
       * @return string
      */
      public function getName(): string
      {
          return $this->name;
      }


      /**
       * @return mixed
      */
      public function getValue(): mixed
      {
          return $this->value;
      }




      /**
       * @return array
      */
      public function getOptions(): array
      {
          return $this->options;
      }




      /**
       * @param $key
       * @param $default
       * @return mixed|null
      */
      public function getOption($key, $default = null): mixed
      {
          return $this->options[$key] ?? $default;
      }




      /**
       * @return FormElement|null
      */
      public function getParent(): ?FormElement
      {
          return $this->parent;
      }



      /**
       * @return string
      */
      public function __toString(): string
      {
          return $this->render();
      }




      /**
       * @param array $attributes
       * @return string
      */
      protected function buildAttributes(array $attributes): string
      {
         $attrs = [];
         foreach ($attributes as $key => $value) {
            if ($value) {
                $attrs[] = sprintf('%s="%s"', $key, $value);
            }
         }
         return join(' ', $attrs);
      }



      /**
       * @return string
      */
      protected function renderLabel(): string
      {
          $label = $this->getOption('label');

          if ($label === false) {
              return '';
          }

          if (is_null($label)) {
              $label = ucfirst($this->name);
          }

          return sprintf('<label for="%s">%s</label>', $this->name, $label);
      }
}