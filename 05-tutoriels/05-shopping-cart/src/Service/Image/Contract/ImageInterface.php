<?php
declare(strict_types=1);

namespace Grafikart\Service\Image\Contract;


/**
 * ImageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Image\Contract
 */
interface ImageInterface
{
     public function getSource(): string;
     public function quality(int $quality): static;
     public function resize(int $with, int $height): static;
     public function crop(int $width, int $height): static;
     public function fill(): static;
     public function save(string $destination);
}