<?php
# php commands/fill.php
# https://github.com/fzaninotto/Faker
require dirname(__DIR__). '/vendor/autoload.php';


$faker = \Faker\Factory::create('fr_FR');


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

    $name      = $faker->sentence();
    $slug      = $faker->slug;
    $createdAt = $faker->date() .' '. $faker->time();
    $content   = $faker->paragraphs(nb: rand(3, 15), asText: true);
    #$content   = $faker->text();

    $sql = "INSERT INTO post SET name='$name', slug='$slug', created_at='$createdAt', content='$content'";
    $pdo->exec($sql);
    echo "[". date('d-m-Y H:i:s') . "] : $sql\n";
}
echo "Finished!\n";
