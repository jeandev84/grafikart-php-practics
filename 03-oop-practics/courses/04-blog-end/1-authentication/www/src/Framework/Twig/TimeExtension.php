<?php
declare(strict_types=1);

namespace Framework\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @TimeExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Twig
 */
class TimeExtension extends AbstractExtension
{

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('ago', [$this, 'ago'], ['is_safe' => ['html']])
        ];
    }


    /**
     * @param \DateTime $date
     * @param string $format
     * @return string
    */
    public function ago(\DateTime $date, string $format = 'd/m/Y H:i'): string
    {
        return '<span class="timeago" datetime="'. $date->format(\DateTime::ISO8601) .'">'. $date->format($format) .'</span>';
    }
}