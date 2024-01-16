<?php
declare(strict_types=1);

namespace Grafikart\HTML\Form;

/**
 * FormBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML\Form
 */
abstract class FormBuilder
{

      /**
       * @param Form $form
       * @return mixed
      */
      abstract public function buildForm(Form $form);
}