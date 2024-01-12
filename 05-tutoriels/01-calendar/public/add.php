<?php

use App\Entity\Event;
use App\Utils\Format;
use App\Validation\Validator;

require '../bootstrap/app.php';

$errors = [];

$connection      = \App\Database\Connection\ConnectionFactory::make();
$eventRepository = new \App\Repository\EventsRepository($connection);
$events          = new \App\Service\Calendar\Events($eventRepository);

$data = [
    'date'  => $_GET['date'] ?? date('Y-m-d'),
    'start' => date('H:i'),
    'end'   => date('H:i')
];

$validator = new Validator($data);
if(!$validator->validate('date', 'date')) {
    $data['date'] = date('Y-m-d');
}

$validator = new \App\Validators\EventValidator();
$param     = new \App\Http\Parameter($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $validator->validates($_POST);
    $param->add($validator->getData());

    if (empty($errors)) {
       $event = $events->hydrate(new Event(), $param);
       if(! $events->createEvent($event)) {
          throw new Exception("Something went wrong during create event");
       }
       header('Location: /?success=1');
       exit;
   }
}

render('header', ['title' => 'Ajouter un evenement']);
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
