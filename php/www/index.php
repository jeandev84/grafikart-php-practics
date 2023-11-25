<?php
require 'vendor/autoload.php';


$request    = \App\Http\Request::createFromGlobals();
$connection = new \App\Database\Connection\PdoConnection("sqlite:./data.sql");


# Query params
$qs          = $request->queries->get('q', '');
$page        = $request->queries->getInt('page', 1);
$perPage     = $request->request->getInt('limit', 20);


# DTO
$search       = new \App\DTO\SearchDto($qs);
$pagination   = new \App\DTO\PaginationDto($page, $perPage);
$dto          = new \App\DTO\GetProducts($search, $pagination);

# Repository
$repository   = new \App\Repository\ProductRepository($connection);
$products     = $repository->findProductsBy($dto);
$totalOfPages = $repository->getTotalPages($dto);

# dd($count['count']);
# dd($totalOfPages);
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

       <!-- Pagination section -->
       <?php if ($totalOfPages > 1 && $page > 1): ?>
           <a href="?<?= \App\Helper\URLHelper::withParam('page', $page - 1) ?>" class="btn btn-primary">Previous page</a>
       <?php endif; ?>

       <?php if ($totalOfPages > 1 && $page < $totalOfPages): ?>
           <a href="?<?= \App\Helper\URLHelper::withParam('page', $page + 1) ?>" class="btn btn-primary">Next page</a>
       <?php endif; ?>
       <!--/ Pagination section -->


   </div>

</body>
</html>

