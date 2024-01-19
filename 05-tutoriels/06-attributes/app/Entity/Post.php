<?php
declare(strict_types=1);

namespace App\Entity;

use Grafikart\Validation\Rules\Attributes\NotBlank;

/**
 * Post
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class Post
{
    #[NotBlank]
    protected string $title;
}