<?php

use App\Utils\Format;

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $validator->validates($_POST);
    $param->add($validator->getData());
    if (empty($errors)) {
        $event->setName($param->get('name'));
        $event->setDescription($param->get('description'));

        $date  = $param->get('date');
        $start = Format::date('Y-m-d H:i', $date . ' '. $param->get('start'));
        $end   = Format::date('Y-m-d H:i', $date . ' '. $param->get('end'));
        $event->setStartAt($start->format('Y-m-d H:i:s'));
        $event->setEndAt($end->format('Y-m-d H:i:s'));
        if(! $events->updateEvent($event, '')) {
            throw new Exception("Something went wrong creating event");
        }
        header('Location: /?success=1');
        exit;
    }
}


render('header', ['title' => $event->getName()])
?>

<div class="container">
    <h1>Editer l' evenement <small><?= h($event->getName()); ?></small></h1>

    <form action="" method="post" class="form">
        <?php render('calendar/form', ['param' => $param, 'validator' => $validator]); ?>
        <div class="form-group">
            <button class="btn btn-primary">Modifier l' evenement</button>
        </div>
    </form>
</div>

<?php render('footer'); ?>

