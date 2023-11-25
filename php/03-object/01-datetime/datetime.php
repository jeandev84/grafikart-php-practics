<?php

// 1. Formatter une date pour afficher la date du jour par examples: 16/04/2022
$date = new DateTime();
echo $date->format('d/m/Y');
echo "\n";


// 2. Afficher la date du jour : 16/04/2022
$time = time();
echo date('d/m/Y', $time);
echo "\n";


// 1. Modifier la date du jour + 1month
$date = new DateTime();
$date->modify('+1 month');
echo $date->format('d/m/Y');
echo "\n";

// 2. Modifier la date du jour + 1month
$time = time();
$time = strtotime('+1 month', $time);
echo date('d/m/Y', $time);
echo "\n";


// 3. Calcul difference de date par approche procedurale

$date1 = '2019-01-01';
$date2 = '2019-04-01';

$time1 = strtotime($date1);
$time2 = strtotime($date2);

// abs   : donne la valeur absulue cad une valeur absolue.
// floor : chiffre arrondit a la valeur inferieure.
$days = floor(abs(($time1 - $time2) / (24 * 60 * 60)));

echo "Il y a $days jours de difference \n";


// 4.  Calcul difference de date par approche object (oriente object)

$date1 = '2019-01-01';
$date2 = '2019-04-01';

$datetime1 = new DateTime($date1);
$datetime2 = new DateTime($date2);

// Object de type DateInterval()
$dateinterval = $datetime1->diff($datetime2, true);
$days = $dateinterval->days;

echo "Il y a {$days}  jours de difference \n";


// 4.  Calcul de difference a grand ecart de date par approche object (oriente object)

$date1 = '2014-01-01';
$date2 = '2019-04-01';

$datetime1 = new DateTime($date1);
$datetime2 = new DateTime($date2);

$diff = $datetime1->diff($datetime2, true);

echo "Il y a {$diff->y} annees, {$diff->m} mois et {$diff->days} jours de difference \n";


echo "=============== DateInterval ===================";


// P1M : Periode d' 1 mois.
// 1D  : 1 Day (1 jour)
// T1M : Time 1 Minute (time une minute)
$interval = new DateInterval('P1M1DT1M');
var_dump($interval);


echo "=============== DateInterval ===================";
$date = new DateTime('2019-01-01');
$interval = new DateInterval('P1M1DT1M');
$date->add($interval);
var_dump($date);

