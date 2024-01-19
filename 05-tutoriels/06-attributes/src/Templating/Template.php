<?php
declare(strict_types=1);

namespace Grafikart\Templating;

use Grafikart\Templating\Exception\TemplateException;

/**
 * Template
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Templating
 */
class Template implements \Stringable
{
     protected string $path;
     protected array  $data = [];


     /**
      * @param string $path
      * @param array $data
     */
     public function __construct(string $path, array $data = [])
     {
         $this->path = $path;
         $this->data = $data;
     }





     /**
      * @inheritDoc
     */
     public function __toString(): string
     {
         if (! file_exists($this->path)) {
             throw new TemplateException("file $this->path does not exist.");
         }

         extract($this->data, EXTR_SKIP);
         ob_start();
         include $this->path;
         return ob_get_clean();
     }
}