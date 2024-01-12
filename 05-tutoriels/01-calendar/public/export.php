<?php
# http://localhost:8080/export.php
require '../bootstrap/app.php';

$connection      = \App\Database\Connection\ConnectionFactory::make();

$eventRepository = new \App\Repository\EventsRepository($connection);
$events          = new \App\Service\Calendar\Events($eventRepository);
$start           = new DateTimeImmutable('first day of january'); # 2024-01-01 00:00:00
$end             = $start->modify('last day of december')->modify('+ 1 day'); # 2025-01-01 00:00:00

$events  = $events->getEventsBetween($start, $end);
?>

<div>id;name;start;end</div>
<?php foreach ($events as $event): ?>
<div>
    <?= $event->getId() ?>;"<?= addslashes($event->getName()) ?>";"<?= $event->getStartAt()->format('Y-m-d') ?>";"<?= $event->getEndAt()->format('Y-m-d') ?>"
</div>
<?php endforeach; ?>





