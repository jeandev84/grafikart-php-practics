<?php
declare(strict_types=1);

namespace App\Service\Calendar;

use Grafikart\Service\Calendar\Calendar;

/**
 * FrenchCalendar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Service\Calendar
 */
class FrenchCalendar extends Calendar
{


    /**
     * @var array|string[]
    */
    protected array $days = [
        'Lundi',
        'Mardi',
        'Mercredi',
        'Jeudi',
        'Vendredi',
        'Samedi',
        'Dimanche'
    ];


    /**
     * @var array
    */
    protected array $months = [
        'Janvier',
        'Février',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Août',
        'Septembre',
        'Octobre',
        'Novembre',
        'Décembre'
    ];



    /**
     * @inheritdoc
    */
    public function __construct(string $year)
    {
        parent::__construct($year);
    }
}