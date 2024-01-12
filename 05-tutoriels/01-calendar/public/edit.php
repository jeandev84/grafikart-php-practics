<?php
require '../bootstrap/app.php';

$connection      = \App\Database\Connection\ConnectionFactory::make();
$eventRepository = new \App\Repository\EventsRepository($connection);
$events          = new \App\Service\Calendar\Events($eventRepository);

if (! isset($_GET['id'])) {
    e404();
}

try {
    $event  = $events->find($_GET['id']);
} catch (Exception $e) {
   e404();
}

$validator = new \App\Validators\EventValidator();
$param     = new \App\Http\Parameter([
    'name'  => $event->getName(),
    'date'  => $event->getStartAt()->format('Y-m-d'),
    'start' => $event->getStartAt()->format('H:i'),
    'end'   => $event->getEndAt()->format('H:i'),
    'description' => $event->getDescription()
]);


render('header', ['title' => $event->getName()])
?>

<h1>Editer l' evenement <small><?= h($event->getName()); ?></small></h1>

<form action="" method="post" class="form">
    <?php render('calendar/form', ['param' => $param, 'validator' => $validator]); ?>
    <div class="form-group">
        <button class="btn btn-primary">Ajouter l' evenement</button>
    </div>
</form>

<?php require '../views/footer.php'; ?>

