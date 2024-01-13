<?php
declare(strict_types=1);

namespace Grafikart\HTML;


/**
 * HtmlElementInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\HTML
 */
interface HtmlElementInterface extends \Stringable
{
     public function renderHtml();
}