<?php

use App\Service\Table;

require '../vendor/autoload.php';


$request    = \App\Http\Request::createFromGlobals();
$connection = new \App\Database\Connection\PdoConnection("sqlite:../data.sql");

$query = (new \App\Database\Connection\QueryBuilder($connection->getPdo()))->from('products');

if ($qs = $request->queries->get('q', '')) {
    $query->where('city LIKE :city')
          ->setParam('city', '%'. $qs . '%');
}

$table = (new Table($query, $request->queries->all()))
         ->sortable('id', 'city', 'price')
         ->format('price', function ($value) {
             return \App\Helper\NumberHelper::price($value);
         })
        ->columns([
            'id' => 'ID',
            'name' => 'Name',
            'city' => 'Ville',
            'price' => 'Prix'
        ]);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biens immobiliers</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body class="p-4">

   <div class="container">

       <h1>Les biens immobiliers</h1>

       <!-- Search section -->
       <form action="" class="mb-4">
           <div class="form-group">
               <input type="text" class="form-control" name="q" placeholder="Rechercher par ville" value="<?= \App\Helper\Str::escape($qs) ?>">
           </div>
           <button class="btn btn-primary">Rechercher</button>
       </form>
       <!--/ end search section -->

       <!-- Table section -->
       <?= $table->render() ?>
       <!--/ end section -->


   </div>

</body>
</html>

