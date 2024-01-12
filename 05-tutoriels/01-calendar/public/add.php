<?php

use App\Validation\Validator;

require '../bootstrap/app.php';

render('header', ['title' => 'Ajouter un evenement']);

$errors = [];

$validator = new \App\Validators\EventValidator();
$param     = new \App\Http\Parameter();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $errors = $validator->validates($_POST);
   $param->add($validator->getData());
   if (empty($errors)) {
       dd($errors);
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
       <div class="row">
           <div class="col-sm-6">
               <div class="form-group">
                   <label for="name">Titre</label>
                   <input type="text" class="form-control" name="name" id="name" value="<?= $param->escape('name', 'Demo') ?>" required>
                   <?php if($validator->hasError('name')):?>
                      <p class="form-text text-muted">
                          <?= $validator->getError('name') ?>
                      </p>
                   <?php endif; ?>
               </div>
           </div>
           <div class="col-sm-6">
               <div class="form-group">
                   <label for="date">Date</label>
                   <input type="date" class="form-control" name="date" id="date" value="<?= $param->escape('date', '2024-01-12') ?>" required>
                   <?php if($validator->hasError('date')):?>
                       <p class="form-text text-muted">
                           <?= $validator->getError('date') ?>
                       </p>
                   <?php endif; ?>
               </div>
           </div>
       </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Demarrage</label>
                    <input type="time" class="form-control" name="start" id="start" placeholder="HH::MM" value="<?= $param->escape('start', '19:00') ?>" required>
                    <?php if($validator->hasError('start')):?>
                        <p class="form-text text-muted">
                            <?= $validator->getError('start') ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input type="time" class="form-control" name="end" id="end" placeholder="HH::MM" value="<?= $param->escape('end', '20:00') ?>" required>
                    <?php if($validator->hasError('end')):?>
                        <p class="form-text text-muted">
                            <?= $validator->getError('end') ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l' evenement</button>
        </div>
    </form>
</div>

<?php render('footer'); ?>
