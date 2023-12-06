<?php
declare(strict_types=1);

namespace Framework\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @TextExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Twig
 */
class TextExtension extends AbstractExtension
{


      /**
       * @return TwigFilter[]
      */
      public function getFilters(): array
      {
          return [
             new TwigFilter('excerpt', [$this, 'excerpt'])
          ];
      }


      /**
       * @param string|null $content
       *  @param int $maxLength
       * @return string
      */
      public function excerpt(?string $content, int $maxLength = 100): string
      {
           if (mb_strlen($content) > $maxLength) {
               $excerpt   = mb_substr($content, 0, $maxLength);
               $lastSpace = mb_strrpos($excerpt, ' ');
               return mb_substr($excerpt, 0, $lastSpace - 1) . "...";
           }

           return $content;
      }
}