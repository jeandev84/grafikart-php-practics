<?php

use App\Utils\Format;
use App\Validation\Validator;

require '../bootstrap/app.php';

render('header', ['title' => 'Ajouter un evenement']);

$errors = [];

$connection      = \App\Database\Connection\ConnectionFactory::make();
$eventRepository = new \App\Repository\EventsRepository($connection);
$events          = new \App\Service\Calendar\Events($eventRepository);

$validator = new \App\Validators\EventValidator();
$param     = new \App\Http\Parameter();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $errors = $validator->validates($_POST);
   $param->add($validator->getData());
   if (empty($errors)) {
       $event = new \App\Entity\Event();
       $event->setName($param->get('name'));
       $event->setDescription($param->get('description'));

       $date  = $param->get('date');
       $start = Format::date('Y-m-d H:i', $date . ' '. $param->get('start'));
       $end   = Format::date('Y-m-d H:i', $date . ' '. $param->get('end'));
       $event->setStartAt($start->format('Y-m-d H:i:s'));
       $event->setEndAt($end->format('Y-m-d H:i:s'));
       if(! $events->create($event)) {
          throw new Exception("Something went wrong creating event");
       }
       header('Location: /?success=1');
       exit;
   }
}
?>

<div class="container">
    <?php if ($validator->hasErrors()): ?>
        <div class="alert alert-danger">
            Merci de corriger vos erreurs
        </div>
    <?php endif; ?>

    <h1>Ajouter un evenement</h1>
    <form action="" method="post" class="form">
        <?php render('calendar/form', ['param' => $param, 'validator' => $validator]); ?>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l' evenement</button>
        </div>
    </form>
</div>

<?php render('footer'); ?>
