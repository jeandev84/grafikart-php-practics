<?php
require 'vendor/autoload.php';

$pdo = new PDO("sqlite:./data.sql", null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$products = $pdo->query("SELECT * FROM products LIMIT 20")->fetchAll();
dd($products);
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
<body>

   <div class="container-fluid">
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
           <tr>
               <td>#1</td>
               <td>Bien 1</td>
               <td>10 000 €</td>
               <td>City</td>
               <td>Address</td>
           </tr>
           </tbody>
       </table>
   </div>

</body>
</html>

