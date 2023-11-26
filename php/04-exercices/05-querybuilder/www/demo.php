<?php

require 'vendor/autoload.php';

$connection = new \App\Database\Connection\PdoConnection("sqlite:data.sqlite");
$qb = new \App\QueryBuilder($connection);

$query = $qb->select(['id', 'username', 'password'])
            ->from("users")
            ->where("id > :id")
            ->setParameters("id", 3)
            #->limit(10)
            ->page(1)
            ->orderBy("id", "desc")
            ->getSQL();

echo $query, "\n";