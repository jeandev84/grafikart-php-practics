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
      protected array $params = [
          'label' => null,
          'attrs' => []
      ];




      /**
       * @param string $name
       * @param $value
       * @param array $params
      */
      public function __construct(string $name, $value, array $params = [])
      {
          $this->name    = $name;
          $this->value   = $value;
          $this->withParams($params);
      }



      /**
       * Render HTML
       *
       * @return string
      */
      abstract public function render(): string;





      /**
       * @param array $params
       * @return $this
      */
      public function withParams(array $params): static
      {
          $this->params = array_merge($this->params, $params);

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
      public function getParams(): array
      {
          return $this->params;
      }




      /**
       * @param $key
       * @param $default
       * @return mixed|null
      */
      public function getParam($key, $default = null): mixed
      {
          return $this->params[$key] ?? $default;
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
       * @param array $attributes
       * @return string
      */
      protected function renderAttributes(array $attributes): string
      {
          if ($attrs = $this->getParam('attrs')) {
              $attributes = array_merge($attributes, $attrs);
          }

          return $this->buildAttributes($attributes);
      }




      /**
       * @param string $key
       * @param $default
       * @return mixed|null
      */
      protected function getAttribute(string $key, $default = null)
      {
           $attrs = $this->getParam('attrs');

           return $attrs[$key] ?? $default;
      }




      /**
       * @return string
      */
      protected function renderLabel(): string
      {
          $label = $this->getParam('label');

          if ($label === false) {
              return '';
          }

          if (is_null($label)) {
              $label = ucfirst($this->name);
          }

          return sprintf('<label for="%s">%s</label>', $this->name, $label);
      }
}