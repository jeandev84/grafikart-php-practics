<?php
declare(strict_types=1);

namespace Grafikart\Console\Input;

/**
 * ArgvInput
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Console\Input
*/
class ArgvInput extends ConsoleInput
{

     /**
      * @param array $tokens
     */
     public function __construct(array $tokens = [])
     {
         parent::__construct($tokens ?: $_SERVER['argv']);
     }

     /**
      * @inheritDoc
     */
     public function parseTokens(array $tokens): void
     {
          foreach ($tokens as $token) {
              [$argument, $value] = explode('=', $token, 2);
              $this->setArguments([$argument => $value]);
          }
     }
}