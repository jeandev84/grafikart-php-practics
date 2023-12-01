<?php
declare(strict_types=1);

namespace Grafikart\Templating;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @TemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Templating
 */
interface TemplateInterface
{
      public function getPath(): string;
      public function getParameters(): array;
      public function __toString(): string;
}