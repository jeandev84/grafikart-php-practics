<?php
declare(strict_types=1);

namespace Grafikart\HTML\Form;

use Grafikart\HTML\Form\Elements\Contract\FormElement;
use Grafikart\HTML\Form\Elements\Input;
use Grafikart\Http\Parameter;

/**
 * Form
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\Form
 */
class Form
{
      /**
       * @var array
      */
      protected array $data = [];


      /**
       * @var FormElement[]
      */
      protected array $elements = [];


      /**
       * @param array $data
      */
      public function __construct(array $data = [])
      {
          $this->data = $data;
      }



      /**
       * @param FormElement $element
       * @return $this
      */
      public function add(FormElement $element): static
      {
         $this->elements[$element->getName()] = $element;

         return $this;
      }




      /**
       * @param string $type
       * @param string $name
       * @param array $options
       * @return string
      */
      public function input(string $type, string $name, array $options = []): string
      {
           $value = $this->getData()->get($name);
           $input = new Input($type, $name, $value, $options);
           return $input->render();
      }




      /**
       * @param string $name
       * @param array $options
       * @return string
      */
      public function text(string $name, array $options = []): string
      {
          return $this->input('text', $name, $options);
      }


      public function textarea(string $name, array $options = []): static
      {
          return $this;
      }



      /**
       * @return Parameter
      */
      public function getData(): Parameter
      {
          return new Parameter($this->data);
      }




      /**
       * @param string $name
       * @param null $default
       * @return mixed
      */
      public function get(string $name, $default = null): mixed
      {
          return $this->getData()->get($name, $default);
      }
}