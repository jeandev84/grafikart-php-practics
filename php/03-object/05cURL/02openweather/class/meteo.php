<?php
require_once 'class/OpenWeather.php';
$weather = new OpenWeather('ca8bd7ffc58648c13b64915a4ae78f09');
$forecast = $weather->getForecast('Montpellier,fr'); // recupere les info de meteos les 16 prochains jours


echo '<pre>';
print_r($forecast);
echo '<pre>';

/*
[
    [
        'temp' => 5.03,
        'description' => '...',
        'date' => new DateTime()
    ]
]

<li>03/01/2018 : Ciel degage
*/