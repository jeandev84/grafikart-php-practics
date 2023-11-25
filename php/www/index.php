<?php
require 'vendor/autoload.php';

$request = \App\Http\Request::createFromGlobals();
$connection = new \App\Database\Connection\PdoConnection("sqlite:./data.sql");

$search     = new \App\DTO\SearchDto($request->queries->get('q', ''));
$dto        = new \App\DTO\GetProducts($search);
$repository = new \App\Repository\ProductRepository($connection);
$products  = $repository->getProductsBy($dto);

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

       <!-- search section -->
       <form action="" class="mb-4">
           <div class="form-group">
               <input type="text" class="form-control" name="q" placeholder="Rechercher par ville">
           </div>
           <button class="btn btn-primary">Rechercher</button>
       </form>
       <!--/ end search section -->

       <!-- table section -->
       <table class="table table-striped">
           <thead>
           <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Price</th>
               <th>City</th>
               <th>Address</th>
           </tr>
           </thead>
           <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>#<?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= \App\Helper\NumberHelper::price($product['price']) ?></td>
                    <td><?= $product['city'] ?></td>
                    <td><?= $product['address'] ?></td>
                </tr>
            <?php endforeach; ?>
           </tbody>
       </table>
       <!--/ end table section -->
   </div>

</body>
</html>

