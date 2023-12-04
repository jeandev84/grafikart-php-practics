<?php

$pdo = new PDO('sqlite:../data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);

try {

    $pdo->beginTransaction();
    $pdo->query('DELETE FROM posts LIMIT 1');
    $pdo->exec('UPDATE posts SET name = "demo" WHERE id = 3');
    $pdo->exec('UPDATE posts SET content = "demo" WHERE id = 3');
    $pdo->commit();
    $post = $pdo->query('SELECT * FROM posts WHERE id = 3')->fetch();
} catch (PDOException $exception) {
    $pdo->rollBack();
}