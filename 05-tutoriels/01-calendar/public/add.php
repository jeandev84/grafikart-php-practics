<?php
require '../bootstrap/app.php';

render('header', ['title' => 'Ajouter un evenement']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}
?>

<div class="container">
    <h1>Ajouter un evenement</h1>
    <form action="" method="post" class="form">
       <div class="row">
           <div class="col-sm-6">
               <div class="form-group">
                   <label for="name">Titre</label>
                   <input type="text" class="form-control" name="name" id="name" value="Demo" required>
               </div>
           </div>
           <div class="col-sm-6">
               <div class="form-group">
                   <label for="date">Date</label>
                   <input type="date" class="form-control" name="date" id="date" value="2024-01-12" required>
               </div>
           </div>
       </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Demarrage</label>
                    <input type="time" class="form-control" name="start" id="start" placeholder="HH::MM" value="19:00" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input type="time" class="form-control" name="end" id="end" placeholder="HH::MM" value="20:00" required>
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
