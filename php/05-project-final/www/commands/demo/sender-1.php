<?php
# php commands/fill.php
$pdo = new PDO('mysql:dbname=tutoblog;host=127.0.0.1', 'root', 'secret', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

echo "Beginning ...\n";
for ($i = 0; $i < 50; $i++) {
    $sql = "INSERT INTO post SET name='Article #$i', slug='article-$i', created_at='2019-05-11 14:00:00', content='lorem ipsum'";
    $pdo->exec($sql);
    echo "[". date('d-m-Y H:i:s') . "] : $sql\n";
}
echo "Finished!\n";
