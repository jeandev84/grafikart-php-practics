<?php
declare(strict_types=1);

namespace Grafikart\Config;

/**
 * Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Config
 */
class Config
{

       /**
        * @param array $params
       */
       public function __construct(protected array $params)
       {
       }




      /**
       * @param string $key
       * @param $default
       * @return mixed
      */
      public function get(string $key, $default = null): mixed
      {
          return $this->params[$key] ?? $default;
      }
}