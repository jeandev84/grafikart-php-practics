<?php
$connection = \App\Database\Connection\ConnectionFactory::make();
$calendar   = new \App\Service\Calendar\Calendar($connection);
?>
<div class="sidebar">
    <?= $calendar->show(2018, 2)?>
    <?= $calendar->show(2018, 3, true)?>
</div>

