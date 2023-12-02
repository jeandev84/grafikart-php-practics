<?php
namespace Grafikart;

require 'autoload.php';

require 'Person.php';
require 'Archer.php';

$merlin = new Person('Merlin');
$harry  = new Person('Harry');


$legolos = new Archer('legolas');
$legolos->attack($harry);

var_dump($merlin, $harry, $legolos);
