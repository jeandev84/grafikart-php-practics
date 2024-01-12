<?php
require '../bootstrap/app.php';

$connection      = \App\Database\Connection\ConnectionFactory::make();
$eventRepository = new \App\Repository\EventsRepository($connection);
$events          = new \App\Service\Calendar\Events($eventRepository);

if (! isset($_GET['id'])) {
    header('Location: 404.php');
}

try {
    $event  = $events->find($_GET['id']);
} catch (Exception $e) {
   e404();
}

render('header', ['title' => $event->getName()])
?>

<h1><?= h($event->getName()); ?></h1>

<ul>
  <li>Date: <?= $event->getStartAt()->format('d/m/Y'); ?></li>
  <li>Heure de demarrage: <?= $event->getStartAt()->format('H:i'); ?></li>
  <li>Heure de fin: <?= $event->getEndAt()->format('H:i'); ?></li>
  <li>
      Description<br>
      <?= h($event->getDescription()); ?>
  </li>

</ul>

<?php require '../views/footer.php'; ?>

